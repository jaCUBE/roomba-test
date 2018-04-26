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
     * @var Position[] List of visited position
     */
    public $history = [];


    /**
     * Navigator constructor.
     * @param Map      $map Map of the room
     * @param Position $position Starting position
     */

    public function __construct(Map $map, Position $position)
    {
        $this->map = $map;
        $this->position = $position;
        $this->addVisited();
    }

    /**
     *  Adds current position into the history of visited.
     */

    private function addVisited(): void
    {
        $position_current = clone $this->position;
        $this->history = array_merge([$position_current], $this->history);
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
            $this->addVisited();
            return true;
        } else {
            return false;
        }
    }

    /**
     * Facade for position turn to the right.
     */

    public function turnRight(): void
    {
        $this->position->turnRight();
    }

    /**
     * Facade for position turn to the left.
     */
    public function turnLeft(): void
    {
        $this->position->turnLeft();
    }

}