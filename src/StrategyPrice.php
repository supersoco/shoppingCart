<?php

namespace Checkout;

interface StrategyPrice
{
    /**
     * @param $amount
     * @return mixed
     */
    public function calculate($amount);
}
