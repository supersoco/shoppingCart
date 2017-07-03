<?php

namespace Tests\Unit\PriceStrategy;

use Checkout\PriceStrategy\ThreeForTwoPriceStrategy;

class ThreeForTwoStrategyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testCalculateUnitaryPrice($price, $amount, $expected)
    {
        $threeForTwoStrategy = new ThreeForTwoPriceStrategy($price);
        $this->assertEquals($threeForTwoStrategy->calculate($amount), $expected);
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [50, 1, 50],
            [10, 3, 20],
            [5, 8, 30]
        ];
    }
}
