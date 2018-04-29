<?php

use PHPUnit\Framework\TestCase;

class PositionTest extends TestCase
{

    /**
     * Tests advance calculation works just fin.
     */
    public function testAdvanceCalculation()
    {
        $position = new Position(1, 1, 'N');
        $advance = $position->buildAdvancePosition();

        $this->assertInstanceOf('Position', $advance);
        $this->assertEquals($position->x, $advance->x);
        $this->assertEquals($position->y, $advance->y + 1);
    }

    /**
     * Tests back calculation works just fin.
     */
    public function testBackCalculation()
    {
        $position = new Position(2, 3, 'E');
        $advance = $position->buildBackPosition();

        $this->assertInstanceOf('Position', $advance);
        $this->assertEquals($position->x, $advance->x + 1);
        $this->assertEquals($position->y, $advance->y);
    }


    /**
     * Tests turning left.
     */

    public function testTurnLeft()
    {
        $position = new Position(1, 1, 'N');
        $position->turnLeft();

        $this->assertEquals($position->facing, 'W');
    }


    /**
     * Tests turning right.
     */

    public function testTurnRight()
    {
        $position = new Position(1, 1, 'E');
        $position->turnRight();

        $this->assertEquals($position->facing, 'S');
    }
}