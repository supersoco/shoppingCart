<?php

namespace Tests\Unit\PriceStrategy;

use Checkout\PriceStrategy\UnitPriceStrategy;

class UnitPriceStrategyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testCalculateUnitaryPrice($price, $amount, $expected)
    {
        $unitPriceStrategy = new UnitPriceStrategy($price);
        $this->assertEquals($unitPriceStrategy->calculate($amount), $expected);
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [100, 0, 0],
            [0, 1, 0],
            [50, 3, 150]
        ];
    }
}
