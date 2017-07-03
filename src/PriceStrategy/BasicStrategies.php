<?php

namespace Checkout\PriceStrategy;

use Checkout\Strategies;

class BasicStrategies implements Strategies
{
    public function settings()
    {
        return [
            'AAA' => [
                'strategies' => [
                    new ThreeForTwoPriceStrategy(100),
                    new PercentagePriceStrategy(100, 10),
                    new UnitPriceStrategy(100)
                ]
            ],
            'BBB' => [
                'strategies' => [
                    new PercentagePriceStrategy(55, 5),
                    new UnitPriceStrategy(55)
                ]
            ],
            'CCC' => [
                'strategies' => [
                    new UnitPriceStrategy(25)
                ]
            ],
            'DDD' => [
                'strategies' => [
                    new ThreeForTwoPriceStrategy(25),
                    new PercentagePriceStrategy(25, 10),
                    new UnitPriceStrategy(25)
                ]
            ]
        ];
    }
}
