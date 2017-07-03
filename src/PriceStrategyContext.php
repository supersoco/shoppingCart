<?php

namespace Checkout;

use Checkout\Cart\Line;

interface PriceStrategyContext
{
    /**
     * @param Line $line
     * @return mixed
     */
    public function calculate(Line $line);
}
