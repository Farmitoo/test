<?php


namespace App\Tests\Unit\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    protected $product;

    public function setUp(): void
    {
        $this->product = new Product('Cuve à gasoil', 100, 'Farmitoo', '10 001', 20);
    }

    public function tearDown(): void
    {
        $this->product = null;
    }

    public function testGetTitle()
    {
        $this->assertSame('Cuve à gasoil', $this->product->getTitle());
    }

    public function testGetPrice()
    {
        $this->assertSame(100, $this->product->getPrice());
    }

    public function testGetBrand()
    {
        $this->assertSame('Farmitoo', $this->product->getBrand());
    }

    public function testGetReference()
    {
        $this->assertSame('10 001', $this->product->getReference());
    }

    public function testGetTva()
    {
        $this->assertSame(20, $this->product->getTva());
    }
}
