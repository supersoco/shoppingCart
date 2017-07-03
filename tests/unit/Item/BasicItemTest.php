<?php

namespace Tests\Unit\Item;

use Checkout\Item\BasicItem;

class BasicCartTest extends \PHPUnit_Framework_TestCase
{
    /** @var BasicItem basicItem */
    private $basicItem;

    public function setUp()
    {
        $this->basicItem = new BasicItem('AAA');
    }

    public function testShouldReturnTrueWhenTwoItemsEqual()
    {
        $this->assertTrue($this->basicItem->equals($this->basicItem));
    }

    public function testShouldReturnTrueWhenTwoItemsNotEqual()
    {
        $item = new BasicItem('BBB');
        $this->assertFalse($this->basicItem->equals($item));
    }

    public function tearDown()
    {
        unset($this->basicItem);
    }
}
