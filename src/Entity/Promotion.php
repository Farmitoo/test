<?php


namespace App\Entity;


class Promotion
{
    /**
     * @var int
     */
    protected $minAmount;

    /**
     * @var int
     */
    protected $reduction;

    /**
     * @var bool
     */
    protected $freeDelivery;

    /**
     * @param int $minAmount
     * @param int $reduction
     * @param bool $freeDelivery
     */
    public function __construct(int $minAmount, int $reduction, bool $freeDelivery)
    {
        $this->minAmount = $minAmount;
        $this->reduction = $reduction;
        $this->freeDelivery = $freeDelivery;
    }

    /**
     * @return int
     */
    public function getMinAmount(): int
    {
        return $this->minAmount;
    }

    /**
     * @param int $minAmount
     * @return Promotion
     */
    public function setMinAmount(int $minAmount): Promotion
    {
        $this->minAmount = $minAmount;
        return $this;
    }

    /**
     * @return int
     */
    public function getReduction(): int
    {
        return $this->reduction;
    }

    /**
     * @param int $reduction
     * @return Promotion
     */
    public function setReduction(int $reduction): Promotion
    {
        $this->reduction = $reduction;
        return $this;
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
     * @return Promotion
     */
    public function setFreeDelivery(bool $freeDelivery): Promotion
    {
        $this->freeDelivery = $freeDelivery;
        return $this;
    }


}
