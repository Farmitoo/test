<?php

namespace App\Entity;

class Promotion
{
    /**
     * @var int
     */
    protected $id;

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

    // pour savoir si la promotion est effectuée ou non
    /**
     * @var bool
     */
    protected $isApplied;

    /**
     * @param int $id
     * @param int $minAmount
     * @param int $reduction
     * @param bool $freeDelivery
     * @param bool $isApplied
     */
    public function __construct(int $id, int $minAmount, int $reduction, bool $freeDelivery, bool $isApplied = false)
    {
        $this->id = $id;
        $this->minAmount = $minAmount;
        $this->reduction = $reduction;
        $this->freeDelivery = $freeDelivery;
        $this->isApplied = $isApplied;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Promotion
     */
    public function setId(int $id): Promotion
    {
        $this->id = $id;
        return $this;
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

    /**
     * @return bool
     */
    public function isApplied(): bool
    {
        return $this->isApplied;
    }

    /**
     * @param bool $isApplied
     * @return Promotion
     */
    public function setIsApplied(bool $isApplied): Promotion
    {
        $this->isApplied = $isApplied;
        return $this;
    }
}
