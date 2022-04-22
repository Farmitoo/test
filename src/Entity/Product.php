<?php

namespace App\Entity;

class Product
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var int
     */
    protected $price;

    /**
     * @var string
     */
    protected $brand;

    /**
     * @var string
     */
    protected $reference;

    /**
     * @var int
     */
    protected $tva;

    /**
     * @param string $title
     * @param int $price
     * @param string $brand
     * @param int $tva
     */
    public function __construct(string $title, int $price, string $brand, string $reference, int $tva)
    {
        $this->title = $title;
        $this->price = $price;
        $this->brand = $brand;
        $this->reference = $reference;
        $this->tva = $tva;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): string
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

    /**
     * @return int
     */
    public function getTva(): int
    {
        return $this->tva;
    }

    /**
     * @param int $tva
     */
    public function setTva(int $tva): void
    {
        $this->tva = $tva;
    }
}
