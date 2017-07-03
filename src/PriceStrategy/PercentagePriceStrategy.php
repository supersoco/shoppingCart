<?php

namespace Checkout\PriceStrategy;

use Checkout\StrategyPrice;

class PercentagePriceStrategy implements StrategyPrice
{
    /** @var int */
    public $min_unit = 0;

    /** @var  int */
    private $price;

    /** @var  int */
    private $percentage;

    /**
     * PercentagePriceStrategy constructor.
     * @param $price
     * @param $percentage
     */
    public function __construct($price, $percentage)
    {
        $this->price = $price;
        $this->percentage = $percentage;
    }

    /**
     * @param $amount
     * @return int
     */
    public function calculate($amount)
    {
        $discountForUnit = $this->price * $this->percentage / 100;
        return ($this->price - $discountForUnit) * $amount;
    }
}
