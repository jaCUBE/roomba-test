<?php
/**
 * Created by PhpStorm.
 * User: jaCUBE
 * Date: 26.04.2018
 * Time: 18:23
 */

use PHPUnit\Framework\TestCase;

class BatteryTest extends TestCase
{

    /**
     * Tests if battery drain is possible.
     */
    public function testDrain()
    {
        $battery = new Battery(50);
        $battery->drain(20);
        $this->assertEquals($battery->level, 30);
    }


    /**
     *  Tests if battery overdrains works as expected.
     */
    public function testOverdrain()
    {
        $battery = new Battery(50);
        $battery->drain(60);
        $this->assertEquals($battery->level, 50);
    }


}