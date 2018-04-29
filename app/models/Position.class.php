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
     * @param int    $x X coords
     * @param int    $y Y coord
     * @param string $facing Facing (N, E, S, W)
     */

    public function __construct(int $x, int $y, string $facing)
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
        // Designated position will be similar to this one
        $position = clone $this;

        // Position advance shift according to facing
        if ($position->facing == 'E') {
            $position->x++;
        } elseif ($position->facing == 'W') {
            $position->x--;
        } elseif ($position->facing == 'N') {
            $position->y--;
        } elseif ($this->facing == 'S') {
            $position->y++;
        }

        return $position;
    }


    /**
     * Builds designated back position.
     * @return Position Designated back position
     */

    public function buildBackPosition(): Position
    {
        // Designated position will be similar to this one
        $position = clone $this;

        // Position back shift according to facing
        if ($position->facing == 'E') {
            $position->x--;
        } elseif ($position->facing == 'W') {
            $position->x++;
        } elseif ($position->facing == 'N') {
            $position->y++;
        } elseif ($this->facing == 'S') {
            $position->y--;
        }

        return $position;
    }


}