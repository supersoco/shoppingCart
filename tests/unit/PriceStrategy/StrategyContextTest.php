<?php

namespace Tests\Unit\PriceStrategy;

use Checkout\Cart\Line;
use Checkout\Item;
use Checkout\PriceStrategy\StrategyContext;
use Checkout\Strategies;

class StrategyContextTest extends \PHPUnit_Framework_TestCase
{
    /** @var  StrategyContext */
    private $strategyContext;

    public function setUp()
    {
        $strategiesMock = $this->getBasicStrategiesMock();
        /** @var  Strategies $strategiesMock */
        $this->strategyContext = new StrategyContext($strategiesMock);
    }

    public function testShouldCorrectGetStrategiesByItem()
    {
        $basicItemMock = $this->getBasicItemMock('AAA');
        /** @var Item $basicItemMock */
        $this->assertEquals(
            $this->strategyContext->getStrategiesByItem($basicItemMock),
            ['threeForTwoPriceStrategy', 'percentagePriceStrategy']
        );
    }

    public function testShouldPriorityByUnitsThreeForTwoDiscount()
    {
        $strategiesMock = $this->getStrategiesMock();
        $basicItemMock = $this->getBasicItemMock('AAA');
        $lineMock = $this->getLineMock($basicItemMock, 5);

        /** @var Line $lineMock */
        $strategy = $this->strategyContext->getStrategyPrice($strategiesMock, $lineMock);
        $this->assertEquals($strategy->name, 'threeForTwoPriceStrategy');
    }

    public function testShouldPriorityByUnitsPercentageDiscount()
    {
        $strategiesMock = $this->getStrategiesMock();
        $basicItemMock = $this->getBasicItemMock('AAA');
        $lineMock = $this->getLineMock($basicItemMock, 2);

        /** @var Line $lineMock */
        $strategy = $this->strategyContext->getStrategyPrice($strategiesMock, $lineMock);
        $this->assertEquals($strategy->name, 'percentagePriceStrategy');
    }

    public function getBasicStrategiesMock()
    {
        $strategies = [
            'AAA' => [
                'strategies' => [
                    'threeForTwoPriceStrategy',
                    'percentagePriceStrategy',
                ]
            ],
            'BBB' => [
                'strategies' => [
                    'percentagePriceStrategy',
                ]
            ]
        ];

        $settingsMock = $this->getMockBuilder('Checkout\PriceStrategy\BasicStrategies')
            ->disableOriginalConstructor()
            ->getMock();

        $settingsMock->expects($this->any())
            ->method('settings')
            ->will($this->returnValue($strategies));

        return $settingsMock;
    }

    public function getStrategiesMock()
    {
        $threeForTwoPriceStrategyMock = $this->getMockBuilder('Checkout\PriceStrategy\ThreeForTwoPriceStrategy')
            ->disableOriginalConstructor()
            ->getMock();
        $threeForTwoPriceStrategyMock->name = 'threeForTwoPriceStrategy';
        $threeForTwoPriceStrategyMock->min_unit = 3;

        $percentagePriceStrategyMock = $this->getMockBuilder('Checkout\PriceStrategy\PercentagePriceStrategy')
            ->disableOriginalConstructor()
            ->getMock();
        $percentagePriceStrategyMock->name = 'percentagePriceStrategy';
        $percentagePriceStrategyMock->min_unit = 0;

        $strategies = [
            $threeForTwoPriceStrategyMock,
            $percentagePriceStrategyMock
        ];

        return $strategies;
    }

    public function getBasicItemMock($sku)
    {
        $basicItemMock = $this->getMockBuilder('Checkout\Item\BasicItem')
            ->disableOriginalConstructor()
            ->getMock();

        $basicItemMock->expects($this->any())
            ->method("getName")
            ->will($this->returnValue($sku));

        return $basicItemMock;
    }

    public function getLineMock($item, $quantity)
    {
        $lineMock = $this->getMockBuilder('Checkout\Cart\Line')
            ->disableOriginalConstructor()
            ->getMock();
        $lineMock->quantity = $quantity;
        $lineMock->item = $item;

        return $lineMock;
    }

    public function tearDown()
    {
        unset($this->strategyContext);
    }
}
