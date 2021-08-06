<?php


namespace App\Entity\Order;


class OrderPrice extends Order
{
    /**
     * @var float
     */
    protected $ht;

    /**
     * @var array
     */
    protected $promotions;

    /**
     * @var float
     */
    protected $htShippingFees;

    /**
     * @var float
     */
    protected $htTotal;

    /**
     * @var float
     */
    protected $tvaTotal;

    /**
     * @var float
     */
    protected $ttcTotal;

    /**
     * OrderPrice constructor.
     * @param array $items
     * @param float $ht
     * @param array $promotions
     * @param float $htShippingFees
     * @param float $htTotal
     * @param float $tvaTotal
     * @param float $ttcTotal
     */
    public function __construct(
        array $items = [],
        float $ht = 0,
        array $promotions = [],
        float $htShippingFees = 0,
        float $htTotal = 0,
        float $tvaTotal = 0,
        float $ttcTotal = 0
    )
    {
        parent::__construct($items);
        $this->ht = $ht;
        $this->promotions = $promotions;
        $this->htShippingFees = $htShippingFees;
        $this->htTotal = $htTotal;
        $this->tvaTotal = $tvaTotal;
        $this->ttcTotal = $ttcTotal;
    }

    /**
     * @return float
     */
    public function getHt()
    {
        return $this->ht;
    }

    /**
     * @param float $ht
     * @return OrderPrice
     */
    public function setHt($ht)
    {
        $this->ht = $ht;
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
     * @return OrderPrice
     */
    public function setPromotions(array $promotions): OrderPrice
    {
        $this->promotions = $promotions;
        return $this;
    }

    /**
     * @return float
     */
    public function getHtShippingFees()
    {
        return $this->htShippingFees;
    }

    /**
     * @param float $htShippingFees
     * @return OrderPrice
     */
    public function setHtShippingFees($htShippingFees)
    {
        $this->htShippingFees = $htShippingFees;
        return $this;
    }

    /**
     * @return float
     */
    public function getHtTotal()
    {
        return $this->htTotal;
    }

    /**
     * @param float $htTotal
     * @return OrderPrice
     */
    public function setHtTotal($htTotal)
    {
        $this->htTotal = $htTotal;
        return $this;
    }

    /**
     * @return float
     */
    public function getTvaTotal()
    {
        return $this->tvaTotal;
    }

    /**
     * @param float $tvaTotal
     * @return OrderPrice
     */
    public function setTvaTotal($tvaTotal)
    {
        $this->tvaTotal = $tvaTotal;
        return $this;
    }

    /**
     * @return float
     */
    public function getTtcTotal()
    {
        return $this->ttcTotal;
    }

    /**
     * @param float $ttcTotal
     * @return OrderPrice
     */
    public function setTtcTotal($ttcTotal)
    {
        $this->ttcTotal = $ttcTotal;
        return $this;
    }



}
