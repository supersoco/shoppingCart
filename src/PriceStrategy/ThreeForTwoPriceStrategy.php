<?php

namespace Checkout\PriceStrategy;

use Checkout\StrategyPrice;

class ThreeForTwoPriceStrategy implements StrategyPrice
{
    /** @var int */
    public $min_unit = 3;

    /** @var  int */
    private $price;

    public function __construct($price)
    {
        $this->price = $price;
    }

    /**
     * @param $amount
     * @return int
     */
    public function calculate($amount)
    {
        $unitsDiscount = floor($amount / 3);
        return ($amount - $unitsDiscount) * $this->price;
    }
}
