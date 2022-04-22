<?php

namespace App\Entity;

/**
 * J'ai laissé en dur le nom de la marque du produit dans l'objet product
 * Cependant, on pourrait très bien imaginer une classe brand qui contiendrait la règle de tva et la règle des frais de port à appliquer par exemple
 */
class Brand
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @param string $title
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }
}