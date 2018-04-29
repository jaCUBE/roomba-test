<?php

use PHPUnit\Framework\TestCase;

class BatteryTest extends TestCase
{

    /**
     * Tests the battery drain is possible.
     */
    public function testDrain()
    {
        $battery = new Battery(50);
        $battery->drain(20);
        $this->assertEquals($battery->level, 30);
    }


    /**
     *  Tests the battery overdrain works as expected.
     */
    public function testOverdrain()
    {
        $battery = new Battery(50);
        $battery->drain(60);
        $this->assertEquals($battery->level, 50);
    }


}