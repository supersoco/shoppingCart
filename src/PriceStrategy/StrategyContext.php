<?php

namespace Checkout\PriceStrategy;

use Checkout\Cart\Line;
use Checkout\Item;
use Checkout\PriceStrategyContext;
use Checkout\Strategies;

class StrategyContext implements PriceStrategyContext
{
    /** @var array */
    private $strategySettings;

    /**
     * StrategyContext constructor.
     * @param Strategies $strategies
     */
    public function __construct(Strategies $strategies)
    {
        $this->strategySettings = $strategies->settings();
    }

    /**
     * @param Line $line
     * @return mixed
     */
    public function calculate(Line $line)
    {
        $strategies = $this->getStrategiesByItem($line->item);
        $strategy = $this->getStrategyPrice($strategies, $line);
        return $strategy->calculate($line->quantity);
    }

    /**
     * @param Item $item
     * @return mixed
     */
    public function getStrategiesByItem(Item $item)
    {
        return $this->strategySettings[$item->getName()]['strategies'];
    }

    /**
     * @param $strategies
     * @param Line $line
     * @return mixed
     */
    public function getStrategyPrice($strategies, Line $line)
    {
        foreach ($strategies as $strategy) {
            if ($strategy->min_unit <= $line->quantity) {
                return $strategy;
            }
        }
        return false;
    }
}
