<?php


namespace App\Entity;


class Discount
{
    /**
     * @var string
     */
    protected $code;

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
     * @var int
     */
    protected $nbItems = 0;

    /**
     * @var \DateTime
     */
    protected $limitDate = null;

    /**
     * @var int
     */
    protected $maxUse = null;

    /**
     * @var bool
     */
    protected $uniqueByCustomer = null;

    /**
     * @param string $code
     * @param int $minAmount
     * @param int $reduction
     * @param bool $freeDelivery
     */
    public function __construct(string $code, int $minAmount, int $reduction, bool $freeDelivery)
    {
        $this->code = $code;
        $this->minAmount = $minAmount;
        $this->reduction = $reduction;
        $this->freeDelivery = $freeDelivery;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
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
     */
    public function setMinAmount(int $minAmount): void
    {
        $this->minAmount = $minAmount;
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
     */
    public function setReduction(int $reduction): void
    {
        $this->reduction = $reduction;
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
     * @return \DateTime
     */
    public function getLimitDate(): ?\DateTime
    {
        return $this->limitDate;
    }

    /**
     * @param \DateTime|null $limitDate
     */
    public function setLimitDate(?\DateTime $limitDate): void
    {
        $this->limitDate = $limitDate;
    }

    /**
     * @return int
     */
    public function getMaxUse(): ?int
    {
        return $this->maxUse;
    }

    /**
     * @param int|null $maxUse
     */
    public function setMaxUse(?int $maxUse): void
    {
        $this->maxUse = $maxUse;
    }

    /**
     * @return bool
     */
    public function isUniqueByCustomer(): ?bool
    {
        return $this->uniqueByCustomer;
    }

    /**
     * @param bool $uniqueByCustomer
     */
    public function setUniqueByCustomer(?bool $uniqueByCustomer): void
    {
        $this->uniqueByCustomer = $uniqueByCustomer;
    }
}
