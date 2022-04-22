<?php

namespace App\Entity;

class Order
{
    /**
     * @var array
     */
    protected $items;

    /**
     * @var array
     */
    protected $promotions;

    /**
     * @var int
     */
    protected $totalPriceHtWithoutShipping = 0;

    /**
     * @var int
     */
    protected $totalPriceHtWithoutShippingWithDiscount = 0;

    /**
     * @var int
     */
    protected $totalPriceHT = 0;

    /**
     * @var int
     */
    protected $totalPrice = 0;

    /**
     * @var int
     */
    protected $totalTva = 0;

    /**
     * @var int
     */
    protected $shippingFees = 0;

    /**
     * @var int
     */
    protected $nbItems;

    /**
     * @var array
     */
    protected $discounts = array();

    /**
     * @var bool
     */
    protected $freeDelivery = false;

    /**
     */
    public function __construct($items)
    {
        $this->items = $items;

        /** @var Item $item */
        foreach ($items as $item) {
            $this->nbItems += $item->getQuantity();
        }
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array $items
     */
    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    /**
     * @param Item $item
     * @return Order
     */
    public function addItem(Item $item): Order
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @return array
     */
    public function getPromotions(): array
    {
        return $this->promotions;
    }

    /**
     * @param array $promotions
     */
    public function setPromotions(array $promotions): void
    {
        $this->promotions = $promotions;
    }

    /**
     * @return int
     */
    public function getTotalPriceHT(): int
    {
        return $this->totalPriceHT;
    }

    /**
     * @param int $totalPriceHT
     */
    public function setTotalPriceHT(int $totalPriceHT): void
    {
        $this->totalPriceHT = $totalPriceHT;
    }

    /**
     * @return int
     */
    public function getTotalPrice(): int
    {
        return $this->totalPrice;
    }

    /**
     * @param int $totalPrice
     */
    public function setTotalPrice(int $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return int
     */
    public function getTotalTva(): int
    {
        return $this->totalTva;
    }

    /**
     * @param int $totalTva
     */
    public function setTotalTva(int $totalTva): void
    {
        $this->totalTva = $totalTva;
    }

    /**
     * @return int
     */
    public function getShippingFees(): int
    {
        return $this->shippingFees;
    }

    /**
     * @param int $shippingFees
     */
    public function setShippingFees(int $shippingFees): void
    {
        $this->shippingFees = $shippingFees;
    }

    /**
     * @return int
     */
    public function getNbItems(): int
    {
        return $this->nbItems;
    }

    /**
     * @param int $nbItems
     */
    public function setNbItems(int $nbItems): void
    {
        $this->nbItems = $nbItems;
    }

    /**
     * @return int
     */
    public function getTotalPriceHtWithoutShipping(): int
    {
        return $this->totalPriceHtWithoutShipping;
    }

    /**
     * @param int $totalPriceHtWithoutShipping
     */
    public function setTotalPriceHtWithoutShipping(int $totalPriceHtWithoutShipping): void
    {
        $this->totalPriceHtWithoutShipping = $totalPriceHtWithoutShipping;
    }

    /**
     * @return int
     */
    public function getTotalPriceHtWithoutShippingWithDiscount(): int
    {
        return $this->totalPriceHtWithoutShippingWithDiscount;
    }

    /**
     * @param int $totalPriceHtWithoutShippingWithDiscount
     */
    public function setTotalPriceHtWithoutShippingWithDiscount(int $totalPriceHtWithoutShippingWithDiscount): void
    {
        $this->totalPriceHtWithoutShippingWithDiscount = $totalPriceHtWithoutShippingWithDiscount;
    }

    /**
     * @return array
     */
    public function getDiscounts(): array
    {
        return $this->discounts;
    }

    /**
     * @param Discount $discount
     */
    public function addDiscount(Discount $discount): void
    {
        if (!in_array($discount->getCode(), $this->discounts)) {
            $this->discounts[$discount->getCode()] = $discount;
        }
    }

    /**
     * @return bool
     */
    public function isFreeDelivery(): bool
    {
        return $this->freeDelivery;
    }

    /**
     * @param bool $freeDelivery
     */
    public function setFreeDelivery(bool $freeDelivery): void
    {
        $this->freeDelivery = $freeDelivery;
    }
}
