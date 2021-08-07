<?php

namespace App\Tests\Unit\Service;

use App\Entity\Brand;
use App\Entity\Item;
use App\Entity\Order\OrderPrice;
use App\Entity\Product;
use App\Entity\Promotion;
use App\Entity\ShippingFees;
use App\Entity\Tva;
use App\Service\BasketService;
use PHPUnit\Framework\TestCase;

class BasketServiceTest extends TestCase
{
    /**
     * @var OrderPrice
     */
    private $order;

    /**
     * @var BasketService
     */
    private $basketService;

    protected function setUp(): void
    {
        $shippingFeesFarmitoo = new ShippingFees(20, 3);
        $tvaFarmitoo = new Tva(20);
        $brandFarmitoo = new Brand(1, 'Farmitoo', $tvaFarmitoo, $shippingFeesFarmitoo);

        $product1 = new Product(1, 'Cuve à gasoil', 250000, $brandFarmitoo);
        $product2 = new Product(2, 'Nettoyant pour cuve', 5000, $brandFarmitoo);

        $promotion1 = new Promotion(1, 50000, 8, false);

        $item1 = new Item($product1, 1);
        $item2 = new Item($product2, 3);

        $this->order = new OrderPrice();
        $this->order->addItem($item1);
        $this->order->addItem($item2);

        $this->order->addPromotion($promotion1);

        $this->basketService = new BasketService();
    }

    public function testCalculateOrderPrice()
    {
        $this->basketService->calculateOrderPrice($this->order);
        self::assertEquals(265000, $this->order->getHt());
        self::assertEquals(40, $this->order->getHtShippingFees());
        self::assertEquals(265040, $this->order->getHtTotal());
        self::assertEquals(53000, $this->order->getTvaTotal());
        self::assertEquals(292596.8, $this->order->getTtcTotal());
    }

    public function testCalculateShippingFees()
    {
        /**
         * frais de port avec tranche de nombre de produit
         */
        $this->order->setHtShippingFees(0);
        try {
            $reflection = new \ReflectionClass(get_class($this->basketService));
        } catch (\ReflectionException $e) {
            throw $exception = new \Exception($e->getMessage(), 500);
        }
        $method = $reflection->getMethod("calculateShippingFees");
        $method->setAccessible(true);
        try {
            $method->invokeArgs($this->basketService, [&$this->order]);
        } catch (\ReflectionException $e) {
            throw $exception = new \Exception($e->getMessage(), 500);
        }
        self::assertEquals(40, $this->order->getHtShippingFees());

        /**
         * frais de port sans tranche de nombre de produit
         */
        $shippingFeesLili = new ShippingFees(5, null);
        $tvaLili = new Tva(20);
        $brandLili = new Brand(3, 'lili', $tvaLili, $shippingFeesLili);
        $product = new Product(3, 'Cuve', 250000, $brandLili);
        $item = new Item($product, 10);
        $this->order->addItem($item);
        $this->order->setHtShippingFees(0);
        try {
            $method->invokeArgs($this->basketService, [&$this->order]);
        } catch (\ReflectionException $e) {
            throw $exception = new \Exception($e->getMessage(), 500);
        }
        self::assertEquals(45, $this->order->getHtShippingFees());
    }

    public function testCalculateTtcWithPromotions()
    {
        /**
         * avec promotions
         */
        $this->order->setTtcTotal(0);
        $this->order->setHtTotal(250000);
        $this->order->setTvaTotal(50000);
        try {
            $reflection = new \ReflectionClass(get_class($this->basketService));
        } catch (\ReflectionException $e) {
            throw $exception = new \Exception($e->getMessage(), 500);
        }
        $method = $reflection->getMethod("calculateTtcWithPromotions");
        $method->setAccessible(true);
        try {
            $method->invokeArgs($this->basketService, [&$this->order]);
        } catch (\ReflectionException $e) {
            throw $exception = new \Exception($e->getMessage(), 500);
        }
        self::assertEquals(276000, $this->order->getTtcTotal());

        /**
         * sans promotions
         */
        $this->order->setPromotions([]);
        $this->order->setTtcTotal(0);
        try {
            $method->invokeArgs($this->basketService, [&$this->order]);
        } catch (\ReflectionException $e) {
            throw $exception = new \Exception($e->getMessage(), 500);
        }
        self::assertEquals(300000, $this->order->getTtcTotal());
    }
}
