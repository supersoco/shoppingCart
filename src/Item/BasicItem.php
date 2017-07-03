<?php

namespace Checkout\Item;

use Checkout\Item;

class BasicItem implements Item
{
    /**
     * @var string
     */
    private $sku;

    /**
     * BasicItem constructor.
     * @param string $sku
     */
    public function __construct($sku)
    {
        $this->sku = $sku;
    }

    /**
     * @param Item $item
     * @return boolean
     */
    public function equals(Item $item)
    {
        return $this->getName() == $item->getName();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->sku;
    }
}
