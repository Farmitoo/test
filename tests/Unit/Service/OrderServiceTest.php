<?php

namespace App\Tests\Unit\Service;

use App\Entity\Discount;
use App\Entity\Order;
use App\Service\OrderService;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class OrderServiceTest extends TestCase
{
    /**
     * @var OrderService $orderService
     */
    protected $orderService;

    /**
     * @var ReflectionClass $orderServiceReflection
     */
    protected $orderServiceReflection;

    public function setUp(): void
    {
        $this->orderService = new OrderService();

        $this->orderServiceReflection = new ReflectionClass(OrderService::class);
    }

    public function tearDown(): void
    {
        $this->orderService = null;
    }

    /**
     * @dataProvider App\Tests\Unit\Service\DataProvider\OrderServiceDataProvider::computeShippingFeesDataProvider
     *
     * @param int $nbItems
     * @param int $shippingFees
     * @param $expectedResult
     * @throws \ReflectionException
     */
    public function testComputeShippingFees(int $nbItems, int $shippingFees, $expectedResult)
    {
        $computeShippingFees = $this->orderServiceReflection->getMethod('computeShippingFees');
        $computeShippingFees->setAccessible(true);

        $result = $computeShippingFees->invokeArgs($this->orderService, array($nbItems, $shippingFees));

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @dataProvider App\Tests\Unit\Service\DataProvider\OrderServiceDataProvider::computeTotalPriceHtDataProvider
     *
     * @param array $items
     * @param $expectedResult
     * @throws \ReflectionException
     */
    public function testComputeTotalPriceHt(array $items, $expectedResult)
    {
        $computeShippingFees = $this->orderServiceReflection->getMethod('computeTotalPriceHt');
        $computeShippingFees->setAccessible(true);

        $result = $computeShippingFees->invokeArgs($this->orderService, array($items));

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @dataProvider App\Tests\Unit\Service\DataProvider\OrderServiceDataProvider::applyDiscountDataProvider
     *
     * @param Order $order
     * @param Discount $discount
     * @param $expectedResult
     * @throws \ReflectionException
     */
    public function testApplyDiscount(Order $order, Discount $discount, $expectedResult)
    {
        $applyDiscount = $this->orderServiceReflection->getMethod('applyDiscount');
        $applyDiscount->setAccessible(true);

        $order = $applyDiscount->invokeArgs($this->orderService, array($order, $discount));

        $this->assertEquals($expectedResult['priceWithoutShippingWithDiscount'], $order->getTotalPriceHtWithoutShippingWithDiscount());
        $this->assertEquals($expectedResult['shippingFees'], $order->getShippingFees());
    }

    /**
     * @dataProvider App\Tests\Unit\Service\DataProvider\OrderServiceDataProvider::newOrderDataProvider
     *
     * @param array $items
     * @param array $discounts
     * @param int $shippingFees
     * @param int $tva
     * @param $expectedResult
     * @throws \ReflectionException
     */
    public function testNewOrder(array $items, array $discounts, int $shippingFees, int $tva, $expectedResult)
    {
        $newOrder = $this->orderServiceReflection->getMethod('newOrder');
        $newOrder->setAccessible(true);

        $order = $newOrder->invokeArgs($this->orderService, array($items, $discounts, $shippingFees, $tva));

        $this->assertEquals($expectedResult, $order);
    }
}