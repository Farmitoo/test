<?php

namespace App\Service;

use App\Entity\Order;
use App\Entity\Discount;

class OrderService
{
    /**
     * Build a new order
     *
     * @param array $items
     * @param array $discounts
     * @param int $shippingFees
     * @param int $tva
     * @return Order
     */
    public function newOrder(array $items, array $discounts, int $shippingFees, int $tva): Order
    {
        $order = new Order($items);

        /** Total price HT without shipping fees */
        $order->setTotalPriceHtWithoutShipping($this->computeTotalPriceHt($items));

        /** Application de promotions */
        foreach ($discounts as $discount) {
            $order = $this->applyDiscount($order, $discount);
        }

        /** Frais de port HT */
        if (!$order->isFreeDelivery()) {
            $order->setShippingFees($this->computeShippingFees($order->getNbItems(), $shippingFees));
        }

        /** Total HT */
        $order->setTotalPriceHT(($order->getTotalPriceHtWithoutShippingWithDiscount() ?: $order->getTotalPriceHtWithoutShipping()) + $order->getShippingFees());

        /** Tva */
        $order->setTotalTva($order->getTotalPriceHT() * ($tva / 100));

        /** Total TTC */
        $order->setTotalPrice($order->getTotalPriceHT() + $order->getTotalTva());

        return $order;
    }

    /**
     * @param array $items
     * @return float|int
     */
    private function computeTotalPriceHt(array $items)
    {
        $totalPriceHtWithoutShipping = 0;

        foreach ($items as $item) {
            $currentProduct = $item->getProduct();
            $productPrice = $currentProduct->getPrice() * $item->getQuantity();

            $totalPriceHtWithoutShipping += $productPrice;
        }

        return $totalPriceHtWithoutShipping;
    }

    /**
     * FDP => 20€ pour 3 produits, soit 40€ pour 4 produits ou 60€ pour 7 produits ..
     *
     * @param int $nbItems
     * @param int $shippingFees
     * @return float|int
     */
    private function computeShippingFees(int $nbItems, int $shippingFees)
    {
        return $shippingFees * ceil($nbItems / 3);
    }

    /**
     * @param Order $order
     * @param Discount $discount
     * @return Order
     */
    private function applyDiscount(Order $order, Discount $discount): Order
    {
        /**
         * Anticipation dans le cas où on souhaiterait ajouter plusieurs code promo
         * Dans ce cas je suppose qu'on vérifie si le nouveau montant est éligible ? Je ne suis pas sûr de ça mais j'ai décidé de procéder ainsi
         */
        $comparePrice = $order->getTotalPriceHtWithoutShippingWithDiscount() > 0 ? $order->getTotalPriceHtWithoutShippingWithDiscount() : $order->getTotalPriceHtWithoutShipping();

        if ($comparePrice >= $discount->getMinAmount()) {
            if ($reduction = $discount->getReduction()) {
                $order->setTotalPriceHtWithoutShippingWithDiscount(round($comparePrice * ((100 - $reduction) / 100), 2));
            }

            if ($discount->isFreeDelivery()) {
                $order->setFreeDelivery(true);
                $order->setShippingFees(0);
            }

            $order->addDiscount($discount);
        }

        return $order;
    }
}