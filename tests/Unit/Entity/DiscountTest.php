<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Discount;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class DiscountTest extends TestCase
{
    protected $discount;

    public function setUp(): void
    {
        $this->discount = new Discount('FARMITOO', 250000, 10, true);
    }

    public function tearDown(): void
    {
        $this->discount = null;
    }

    public function testGetCode()
    {
        $this->assertSame('FARMITOO', $this->discount->getCode());
    }

    public function testGetMinAmount()
    {
        $this->assertSame(250000, $this->discount->getMinAmount());
    }

    public function testGetReduction()
    {
        $this->assertSame(10, $this->discount->getReduction());
    }

    public function testIsFreeDelivery()
    {
        $this->assertSame(true, $this->discount->isFreeDelivery());
    }
}