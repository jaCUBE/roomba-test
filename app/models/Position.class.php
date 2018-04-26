<?php

/**
 * One position of Roomba in the room. Provides Roomba turning around and predicate advance position.
 * @class Position
 * @author Jakub Rychecký <jakub@rychecky.cz>
 */

class Position
{
    /**
     * Position constructor.
     * @param $x X coords
     * @param $y Y coord
     * @param $facing Facing (N, E, S, W)
     */
    public function __construct($x, $y, $facing)
    {
        $this->x = $x;
        $this->y = $y;
        $this->facing = $facing;
    }


    /**
     * Turns right (clockwise).
     */
    public function turnRight(): void
    {
        $rotate = ['N' => 'E', 'E' => 'S', 'S' => 'W', 'W' => 'N'];
        $this->facing = $rotate[$this->facing];
    }


    /**
     *  Turns left (anticlockwise).
     */
    public function turnLeft(): void
    {
        $rotate = ['N' => 'W', 'W' => 'S', 'S' => 'E', 'E' => 'N'];
        $this->facing = $rotate[$this->facing];
    }


    /**
     * Builds designated advance position.
     * @return Position Designated advance position
     */

    public function buildAdvancePosition(): Position
    {
        // Theoretic designated coordinates
        $x = $this->calculateAdvancePositionX();
        $y = $this->calculateAdvancePositionY();

        return new Position($x, $y, $this->facing);
    }


    /**
     * Calculates X coord if moved with current facing.
     * @return int X designated advance coord
     */

    private function calculateAdvancePositionX(): int
    {
        if ($this->facing == 'E') {
            return $this->x + 1;
        } elseif ($this->facing == 'W') {
            return $this->x - 1;
        } else {
            return $this->x;
        }
    }


    /**
     * Calculates Y coord if moved with current facing.
     * @return int Y designated advance coord
     */

    private function calculateAdvancePositionY(): int
    {
        if ($this->facing == 'N') {
            return $this->y - 1;
        } elseif ($this->facing == 'S') {
            return $this->y + 1;
        } else {
            return $this->y;
        }
    }

}