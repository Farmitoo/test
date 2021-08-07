<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Brand;
use App\Entity\Item;
use App\Entity\Order\Order;
use App\Entity\Product;
use App\Entity\ShippingFees;
use App\Entity\Tva;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    /**
     * @var Product
     */
    private $product1;

    /**
     * @var Product
     */
    private $product2;

    protected function setUp(): void
    {
        $shippingFeesFarmitoo = new ShippingFees(20, 3);
        $tvaFarmitoo = new Tva(20);
        $brandFarmitoo = new Brand(1, 'Farmitoo', $tvaFarmitoo, $shippingFeesFarmitoo);

        $this->product1 = new Product(1, 'Cuve à gasoil', 250000, $brandFarmitoo);
        $this->product2 = new Product(2, 'Nettoyant pour cuve', 5000, $brandFarmitoo);
    }

    public function testAddItem()
    {
        $item1 = new Item($this->product1, 1);
        $item2 = new Item($this->product2, 3);

        $order = new Order();
        $order->addItem($item1);
        self::assertCount(1, $order->getItems());
        $order->addItem($item2);
        self::assertCount(2, $order->getItems());
        $order->addItem($item1);
        self::assertCount(2, $order->getItems());
        $i = 2;
        /* @var Item $item */
        foreach ($order->getItems() as $item) {
            self::assertEquals($i, $item->getProduct()->getId());
            $i--;
        }
    }
}
