<?php

namespace Checkout\Cart;

use Checkout\Item;

class Line
{
    /** @var  \int */
    public $quantity;

    /** @var  Item */
    public $item;

    public function __construct(Item $item, $quantity)
    {
        $this->item = $item;
        $this->quantity = $quantity;
    }
}
