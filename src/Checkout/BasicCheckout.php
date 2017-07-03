<?php

namespace Checkout\Checkout;

use Checkout\Cart;
use Checkout\Checkout;
use Checkout\PriceStrategy\BasicStrategies;
use Checkout\PriceStrategy\StrategyContext;

class BasicCheckout implements Checkout
{
    private $strategyContext;

    public function __construct(StrategyContext $strategyContext)
    {
        $this->strategyContext = $strategyContext;
    }

    /**
     * @return BasicCheckout
     */
    public static function createBasicCheckout()
    {
        return new self(new StrategyContext(new BasicStrategies()));
    }

    /**
     * @param Cart $cart
     * @return float
     */
    public function calculate(Cart $cart)
    {
        $total = 0;
        /** @var Cart\BasicCart $cart */
        foreach ($cart->linesCart as $key => $line) {
            $total += $this->strategyContext->calculate($line);
        }
        return $total;
    }
}
