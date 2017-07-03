<?php

namespace Checkout\PriceStrategy;

use Checkout\StrategyPrice;

class UnitPriceStrategy implements StrategyPrice
{
    /** @var int  */
    public $min_unit = 0;

    /** @var  int */
    private $price;

    /**
     * UnitPriceStrategy constructor.
     * @param $price
     */
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
        return $this->price * $amount;
    }
}
