<?php

namespace App\Entity;

class Tva
{
    /**
     * @var int
     */
    protected $value;

    /**
     * Tva constructor.
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return Tva
     */
    public function setValue(int $value): Tva
    {
        $this->value = $value;
        return $this;
    }
}
