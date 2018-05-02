<?php

/**
 * Navigator provides features to move in the room.
 * @class Navigator
 * @author Jakub Rychecký <jakub@rychecky.cz>
 */

class Navigator
{
    /**
     * @var Map Map of the room
     */
    public $map;

    /**
     * @var Position Current robot position
     */
    public $position;


    /**
     * Navigator constructor.
     * @param Map      $map Map of the room
     * @param Position $position Starting position
     */

    public function __construct(Map $map, Position $position)
    {
        $this->map = $map;
        $this->position = $position;
    }


    /**
     * Do advance in the direction of current facing.
     * @return bool Has been advance done?
     */

    public function advance(): bool
    {
        // Designated advance position
        $position = $this->position->buildAdvancePosition();

        // Checks if position is valid in current map
        if ($this->map->isPositionValid($position)) {
            // Updates current position with designated coordination
            $this->position = $position;
            return true;
        } else {
            // Ouch! It's been a hit!
            return false;
        }
    }


    /**
     * Sends Roomba back in the opposite direction of current facing.
     * @return bool Has been back done?
     */

    public function back(): bool
    {
        // Designated back position
        $position = $this->position->buildBackPosition();

        // Checks if position is valid in current map
        if ($this->map->isPositionValid($position)) {
            // Updates current position with designated coordination
            $this->position = $position;
            return true;
        } else {
            // Ouch! It's been a hit!
            return false;
        }
    }


    /**
     * Facade for position turn to the right.
     * @return void
     */

    public function turnRight(): void
    {
        $this->position->turnRight();
    }


    /**
     * Facade for position turn to the left.
     * @return void
     */

    public function turnLeft(): void
    {
        $this->position->turnLeft();
    }

}