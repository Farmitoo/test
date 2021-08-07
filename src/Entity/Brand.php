<?php

namespace App\Entity;

class Brand
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Tva
     */
    protected $tva;

    /**
     * @var ShippingFees
     */
    protected $shippingFees;

    /**
     * Brand constructor.
     * @param int $id
     * @param string $name
     * @param Tva $tva
     * @param ShippingFees $shippingFees
     */
    public function __construct(int $id, string $name, Tva $tva, ShippingFees $shippingFees)
    {
        $this->id = $id;
        $this->name = $name;
        $this->tva = $tva;
        $this->shippingFees = $shippingFees;
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
     * @return Brand
     */
    public function setId(int $id): Brand
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Brand
     */
    public function setName(string $name): Brand
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Tva
     */
    public function getTva(): Tva
    {
        return $this->tva;
    }

    /**
     * @param Tva $tva
     * @return Brand
     */
    public function setTva(Tva $tva): Brand
    {
        $this->tva = $tva;
        return $this;
    }

    /**
     * @return ShippingFees
     */
    public function getShippingFees(): ShippingFees
    {
        return $this->shippingFees;
    }

    /**
     * @param ShippingFees $shippingFees
     * @return Brand
     */
    public function setShippingFees(ShippingFees $shippingFees): Brand
    {
        $this->shippingFees = $shippingFees;
        return $this;
    }
}
