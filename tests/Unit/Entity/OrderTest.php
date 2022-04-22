<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Item;
use App\Entity\Order;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    protected $order = null;

    public function setUp(): void
    {
        $product1 = new Product('Cuve à gasoil', 250000, 'Farmitoo', '10 0001', 20);
        $product2 = new Product('Nettoyant pour cuve', 5000, 'Farmitoo', '10 0002', 20);
        $product3 = new Product('Piquet de clôture', 1000, 'Gallagher', '10 0003', 20);

        $items = [new Item($product1, 1), new Item($product2, 3), new Item($product3, 5)];

        $this->order = new Order($items);
    }

    public function tearDown(): void
    {
        $this->order = null;
    }

    public function testGetNbItems()
    {
        $this->assertSame(9, $this->order->getNbItems());
    }

    public function testGetItems()
    {
        $product1 = new Product('Cuve à gasoil', 250000, 'Farmitoo', '10 0001', 20);
        $product2 = new Product('Nettoyant pour cuve', 5000, 'Farmitoo', '10 0002', 20);
        $product3 = new Product('Piquet de clôture', 1000, 'Gallagher', '10 0003', 20);

        $items = [new Item($product1, 1), new Item($product2, 3), new Item($product3, 5)];

        $this->assertEquals($items, $this->order->getItems());
    }
}