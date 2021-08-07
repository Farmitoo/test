<?php

namespace App\Entity\Order;

use App\Entity\Item;

class Order
{
    /**
     * @var array
     */
    protected $items;

    /**
     * Order constructor.
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
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
     * @return Order
     */
    public function setItems(array $items): Order
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @param Item $item
     * @return Order
     */
    public function addItem(Item $item): Order
    {
        // supprime si l'item existe déjà
        /* @var Item $it */
        foreach ($this->items as $key => $it) {
            if ($it->getProduct()->getId() === $item->getProduct()->getId()) {
                unset($this->items[$key]);
                break;
            }
        }
        $this->items[] = $item;

        return $this;
    }
}
