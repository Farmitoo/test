<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Item;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    protected $item;

    public function setUp(): void
    {
        $this->item = new Item(new Product('Cuve à gasoil', 100, 'Farmitoo', '10 001', 20), 2);
    }

    public function tearDown(): void
    {
        $this->item = null;
    }

    public function testGetQuantity()
    {
        $this->assertSame(2, $this->item->getQuantity());
    }

    public function testGetPrice()
    {
        $this->assertSame(200, $this->item->getPriceHt());
    }

    public function testGetProduct()
    {
        $product = new Product('Cuve à gasoil', 100, 'Farmitoo', '10 001', 20);

        $this->assertEquals($product, $this->item->getProduct());
    }
}