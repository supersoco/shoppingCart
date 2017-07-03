<?php

namespace Checkout\Cart;

use Checkout\Cart;
use Checkout\Item;

class BasicCart implements Cart
{
    /** @var array */
    public $itemsCart = [];

    /** @var array */
    public $linesCart = [];

    /**
     * @return BasicCart
     */
    public static function create()
    {
        return new self();
    }

    /**
     * @param Item $item
     * @param int $qty
     */
    public function addItem(Item $item, $qty)
    {
        if (!$this->itemHasCart($item)) {
            $this->itemsCart[$item->getName()] = $item;
            $this->addLine($item, $qty);
        } else {
            $this->updateLineQuantity($item, $qty);
        }
    }

    /**
     * @param Item $item
     * @return bool
     */
    public function itemHasCart(Item $item)
    {
        if (array_key_exists($item->getName(), $this->itemsCart)) {
            return true;
        }
        return false;
    }

    /**
     * @param Item $item
     * @param $qty
     */
    public function addLine(Item $item, $qty)
    {
        $this->linesCart[$item->getName()] = new Line($item, $qty);
    }

    /**
     * @param Item $item
     * @param $qty
     */
    public function updateLineQuantity(Item $item, $qty)
    {
        $this->linesCart[$item->getName()]->quantity += $qty;
    }
}
