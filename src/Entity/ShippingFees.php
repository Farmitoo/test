<?php

namespace App\Entity;

class ShippingFees
{
    /**
     * @var float
     */
    protected $value;

    /**
     * @var int
     */
    protected $slice;

    /**
     * ShippingFees constructor.
     * @param float $value
     * @param int|null $slice
     */
    public function __construct(float $value, ?int $slice)
    {
        $this->value = $value;
        $this->slice = $slice;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return ShippingFees
     */
    public function setValue(float $value): ShippingFees
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSlice(): ?int
    {
        return $this->slice;
    }

    /**
     * @param int|null $slice
     * @return ShippingFees
     */
    public function setSlice(?int $slice): ShippingFees
    {
        $this->slice = $slice;
        return $this;
    }
}
