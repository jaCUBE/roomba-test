<?php

/**
 * Map for of the room... for Roomba.
 * @class Map
 * @author Jakub Rychecký <jakub@rychecky.cz>
 */

class Map
{
    /**
     * @var array $map Map in the form matrix as inputted
     */
    public $map = [];


    /**
     * Map constructor.
     * @param array $map Map in the form of matrix
     */
    public function __construct(array $map)
    {
        $this->map = $map;
    }

    /**
     * Checks if designated position is not an obstacle or outside of map.
     * @param Position $position Designated position
     * @return bool Is position valid?
     */

    public function isPositionValid(Position $position)
    {
        return $this->isReachable($position->x, $position->y);
    }

    /**
     * Checks if coordinates is reachable surface and not an obstacle or a wall.
     * @param int $x Coord X
     * @param int $y Coord Y
     * @return bool Is reachable surface?
     */
    public function isReachable(int $x, int $y): bool
    {
        // C = column, "null" wall, empty string = out of matrix
        return !in_array($this->getValue($x, $y), ['null', 'C', '']);
    }


    /**
     * Gets map value for X and Y coords.
     * @param int $x Coord X
     * @param int $y Coord Y
     * @return string Value of the map (S = surface, C = column, null = out of map)
     */

    public function getValue(int $x, int $y): string
    {
        return (string)@$this->map[$y][$x];
    }

}