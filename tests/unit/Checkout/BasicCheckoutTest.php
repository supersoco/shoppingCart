<?php

namespace Tests\Unit\Checkout;

use Checkout\Checkout\BasicCheckout;

class BasicCheckoutTest extends \PHPUnit_Framework_TestCase
{
    public function testCalculateTotalCheckoutPrice()
    {
        $basicCartMock = $this->getBasicCartMock();
        $strategyContextMock = $this->getStrategyContextMock();
        $checkout = new BasicCheckout($strategyContextMock);
        $total = $checkout->calculate($basicCartMock);
        $this->assertEquals($total, 200);
    }

    public function getStrategyContextMock()
    {
        $strategyMock = $this->getMockBuilder('Checkout\PriceStrategy\StrategyContext')
            ->disableOriginalConstructor()
            ->getMock();
        $strategyMock->expects($this->any())
            ->method('calculate')
            ->will($this->returnValue(100));
        return $strategyMock;
    }

    public function getBasicCartMock()
    {
        $lineMock = $this->getMockBuilder('Checkout\Cart\Line')
            ->disableOriginalConstructor()
            ->getMock();
        $basicCartMock = $this->getMockBuilder('Checkout\Cart\BasicCart')
            ->disableOriginalConstructor()
            ->getMock();
        $basicCartMock->linesCart = [
            'AAA' => $lineMock,
            'BBB' => $lineMock
        ];
        return $basicCartMock;
    }
}
