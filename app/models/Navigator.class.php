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
    public $visited = [];

    /**
     * @var Position[] List of cleaned position
     */
    public $cleaned = [];


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
        $this->visited = array_merge([$position_current], $this->visited);
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

    public function back(): bool
    {
        // Designated advance position
        $position = $this->position->buildBackPosition();

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

    /**
     *  Adds current position into the history of visited.
     */

    public function clean(): void
    {
        $position_current = clone $this->position;
        $this->cleaned = array_merge([$position_current], $this->cleaned);
    }

}