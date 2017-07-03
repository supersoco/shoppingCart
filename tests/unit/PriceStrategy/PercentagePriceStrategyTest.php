<?php

namespace Tests\Unit\PriceStrategy;

use Checkout\PriceStrategy\PercentagePriceStrategy;

class PercentagePriceStrategyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testCalculateUnitaryPrice($price, $percentage, $amount, $expected)
    {
        $percentagePriceStrategy = new PercentagePriceStrategy($price, $percentage);
        $this->assertEquals($percentagePriceStrategy->calculate($amount), $expected);
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [100, 50, 4, 200],
            [100, 0, 1, 100],
            [-10, 50, 1, -5],
            [0, 50, 2, 0],
        ];
    }
}
