<?php

namespace App\Tests\Unit\Service\DataProvider;

use App\Entity\Discount;
use App\Entity\Item;
use App\Entity\Order;
use App\Entity\Product;

class OrderServiceDataProvider
{
    public function computeShippingFeesDataProvider()
    {
        return [
            'freeShipping' => [5, 0, 0],
            'shippingFees40' => [5, 20, 40],
            'shippingFees40Bis' => [6, 20, 40]
        ];
    }

    public function computeTotalPriceHtDataProvider()
    {
        $product1 = new Product('Cuve à gasoil', 250000, 'Farmitoo', '10 0001', 20);
        $product2 = new Product('Nettoyant pour cuve', 5000, 'Farmitoo', '10 0002', 20);
        $product3 = new Product('Piquet de clôture', 1000, 'Gallagher', '10 0003', 20);

        $oneItem = [new Item($product1, 1)];
        $threeItems = [new Item($product1, 1), new Item($product2, 3), new Item($product3, 5)];
        $twoItemsWithZero = [new Item($product1, 1), new Item($product2, 0)];

        return [
            'oneItem' => [
                $oneItem,
                250000
            ],
            'threeItems' => [
                $threeItems,
                270000
            ],
            'twoItemsWithZero' => [
                $twoItemsWithZero,
                250000
            ],
        ];
    }

    public function applyDiscountDataProvider()
    {
        $product1 = new Product('Cuve à gasoil', 250000, 'Farmitoo', '10 0001', 20);
        $product2 = new Product('Nettoyant pour cuve', 5000, 'Farmitoo', '10 0002', 20);
        $product3 = new Product('Piquet de clôture', 1000, 'Gallagher', '10 0003', 20);

        $items = [new Item($product1, 1), new Item($product2, 3), new Item($product3, 5)];

        $order = new Order($items);
        $order->setTotalPriceHtWithoutShipping(250000);
        $order->setShippingFees(20);

        $orderTwo = new Order($items);
        $orderTwo->setTotalPriceHtWithoutShipping(250000);
        $orderTwo->setShippingFees(20);

        $orderThree = new Order($items);
        $orderThree->setTotalPriceHtWithoutShipping(250000);
        $orderThree->setShippingFees(20);

        $discount = new Discount('FARMITOO', 50000, 8, false);
        $discountTwo = new Discount('FARMITOO', 50000, 10, true);
        $discountThree = new Discount('FARMITOO', 300000, 10, false);

        return [
            'discountAndShippingFees' => [
                $order,
                $discount,
                [
                    'priceWithoutShippingWithDiscount' => 230000,
                    'shippingFees' => 20
                ]
            ],
            'onlyDiscount' => [
                $orderTwo,
                $discountTwo,
                [
                    'priceWithoutShippingWithDiscount' => 225000,
                    'shippingFees' => 0
                ]
            ],
            'noDiscount' => [
                $orderThree,
                $discountThree,
                [
                    'priceWithoutShippingWithDiscount' => 0,
                    'shippingFees' => 20
                ]
            ],
        ];
    }

    public function newOrderDataProvider()
    {
        $product1 = new Product('Cuve à gasoil', 250000, 'Farmitoo', '10 0001', 20);
        $product2 = new Product('Nettoyant pour cuve', 5000, 'Farmitoo', '10 0002', 20);
        $product3 = new Product('Piquet de clôture', 1000, 'Gallagher', '10 0003', 20);

        $items = [new Item($product1, 1), new Item($product2, 3), new Item($product3, 5)];

        $discount = new Discount('FARMITOO', 300000, 8, false);

        $order = new Order($items);
        $order->setTotalPriceHtWithoutShipping(270000);
        $order->setTotalPriceHtWithoutShippingWithDiscount(0);
        $order->setShippingFees(60);
        $order->setTotalPriceHT(270060);
        $order->setTotalTva(54012);
        $order->setTotalPrice(324072);

        $discountTwo = new Discount('FARMITOO', 250000, 8, false);

        $orderTwo = new Order($items);
        $orderTwo->setTotalPriceHtWithoutShipping(270000);
        $orderTwo->setTotalPriceHtWithoutShippingWithDiscount(248400);
        $orderTwo->setShippingFees(60);
        $orderTwo->setTotalPriceHT(248460);
        $orderTwo->setTotalTva(49692);
        $orderTwo->setTotalPrice(298152);
        $orderTwo->addDiscount($discountTwo);

        return [
            'orderWithoutDiscount' => [
                $items,
                [$discount],
                20,
                20,
                $order
            ],
            'orderWithDiscount' => [
                $items,
                [$discountTwo],
                20,
                20,
                $orderTwo
            ]
        ];
    }
}