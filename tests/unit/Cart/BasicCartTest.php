<?php

namespace Tests\Unit\Cart;

use Checkout\Cart\BasicCart;
use Checkout\Item\BasicItem;

class BasicCartTest extends \PHPUnit_Framework_TestCase
{
    /** @var BasicCart basicCart */
    private $basicCart;

    /** @var BasicItem basicItemMock */
    private $basicItemMock;

    public function setUp()
    {
        $this->basicCart = BasicCart::create();
        $this->basicItemMock = $this->getBasicItemMock('AAA');
    }

    public function testShouldAddItemToCart()
    {
        $this->basicCart->addItem($this->basicItemMock, 11);
        $this->assertEquals($this->basicCart->itemsCart['AAA']->getName(), 'AAA');
    }

    public function testShouldAddLineToCart()
    {
        $this->basicCart->addLine($this->basicItemMock, 11);
        $this->assertEquals($this->basicCart->linesCart['AAA']->quantity, 11);
        $this->assertEquals($this->basicCart->linesCart['AAA']->item->getName(), 'AAA');
    }

    public function testShouldUpdateLineItemQuantity()
    {
        $lineMock = $this->getMockBuilder('Checkout\Cart\Line')
            ->disableOriginalConstructor()
            ->getMock();
        $lineMock->quantity = 3;
        $lineMock->item = $this->basicItemMock;

        $this->basicCart->linesCart['AAA'] = $lineMock;
        $this->basicCart->updateLineQuantity($this->basicItemMock, 1);
        $this->assertEquals($this->basicCart->linesCart['AAA']->quantity, 4);
    }

    public function testShouldReturnTrueWhenItemExistInCart()
    {
        $this->basicCart->itemsCart['AAA'] = $this->basicItemMock;
        $this->assertTrue($this->basicCart->itemHasCart($this->basicItemMock));
    }

    public function testShouldReturnFalseWhenItemNotExistInCart()
    {
        $basicItemMockB = $this->getBasicItemMock('BBB');
        $this->basicCart->itemsCart['BBB'] = $basicItemMockB;
        $this->assertFalse($this->basicCart->itemHasCart($this->basicItemMock));
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

    public function tearDown()
    {
        unset($this->basicCart, $this->basicItemMock);
    }
}
