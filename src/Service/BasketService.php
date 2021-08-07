<?php

namespace App\Service;

use App\Entity\Item;
use App\Entity\Order\OrderPrice;
use App\Entity\Promotion;

class BasketService
{
    public function __construct()
    {
    }

    /**
     * @param OrderPrice $order
     */
    public function calculateOrderPrice(OrderPrice &$order): void
    {
        $ht = 0;
        $tvaTotal = 0;

        $this->calculateShippingFees($order);

        /* @var $item Item */
        foreach ($order->getItems() as $item) {
            $ht += $item->getProduct()->getPrice() * $item->getQuantity();
            // il faudra créer une nouvelle fonction lorsque la TVA sera plus compliqué à calculer
            $tvaTotal += ($item->getProduct()->getPrice() * $item->getProduct()->getBrand()->getTva()->getValue() / 100)
                * $item->getQuantity();
        }
        $order->setHt($ht);
        // je pars du principe qu'il n'y a pas de TVA sur les frais de port
        $htTotal = $ht + $order->getHtShippingFees();
        $order->setHtTotal($htTotal);
        $order->setTvaTotal($tvaTotal);
        $this->calculateTtcWithPromotions($order);
    }

    /**
     * @param OrderPrice $order
     */
    private function calculateShippingFees(OrderPrice &$order): void
    {
        $numberItemByBrand = [];
        $htShippingFees = 0;
        /* @var $item Item */
        foreach ($order->getItems() as $item) {
            if (!isset($numberItemByBrand[$item->getProduct()->getBrand()->getId()])) {
                $numberItemByBrand[$item->getProduct()->getBrand()->getId()] = [
                    $item->getQuantity(),
                    $item->getProduct()->getBrand()->getShippingFees()
                    ];
            } else {
                $numberItemByBrand[$item->getProduct()->getBrand()->getId()][0] += $item->getQuantity();
            }
        }
        foreach ($numberItemByBrand as $brandItems) {
            if ($brandItems[1]->getSlice() === null) {
                $htShippingFees += $brandItems[1]->getValue();
            } else {
                $htShippingFees += ceil($brandItems[0]/$brandItems[1]->getSlice()) * $brandItems[1]->getValue();
            }
        }
        $order->setHtShippingFees($htShippingFees);
    }

    /**
     * @param OrderPrice $order
     */
    private function calculateTtcWithPromotions(OrderPrice &$order): void
    {
        $ttcTotal = $order->getHtTotal() + $order->getTvaTotal();
        $promotions = $order->getPromotions();
        $percentage = 0;
        // j'additionne les pourcentages (plus rapide que de faire le calcule à chaque fois sur le TTC total)
        /* @var $promo Promotion */
        foreach ($promotions as $promo) {
            if ($promo->getMinAmount() <= $ttcTotal) {
                $percentage += $promo->getReduction();
                $promo->setIsApplied(true);
            }
        }
        $ttcTotal = $ttcTotal - ($ttcTotal * $percentage / 100);
        $order->setTtcTotal($ttcTotal);
    }
}
