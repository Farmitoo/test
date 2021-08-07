<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Order\OrderPrice;
use App\Entity\Promotion;
use PHPUnit\Framework\TestCase;

class OrderPriceTest extends TestCase
{

    /**
     * @var Promotion
     */
    private $promotion1;

    /**
     * @var Promotion
     */
    private $promotion2;

    protected function setUp(): void
    {
        $this->promotion1 = new Promotion(1, 5000, 10, false);
        $this->promotion2 = new Promotion(2, 6000, 20, false);
    }

    public function testAddPromotion()
    {
        $order = new OrderPrice();
        $order->addPromotion($this->promotion1);
        self::assertCount(1, $order->getPromotions());
        $order->addPromotion($this->promotion2);
        self::assertCount(2, $order->getPromotions());
        $order->addPromotion($this->promotion1);
        self::assertCount(2, $order->getPromotions());
        $i = 2;
        /* @var Promotion $promo */
        foreach ($order->getPromotions() as $promo) {
            self::assertEquals($i, $promo->getId());
            $i--;
        }
    }
}
