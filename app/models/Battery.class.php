<?php

/**
 * Battery for lil' Roomba.
 * @class Battery
 * @author Jakub Rychecký <jakub@rychecky.cz>
 */

class Battery
{
    /**
     * @var int $level Battery level
     */
    public $level;


    /**
     * Battery constructor.
     * @param int $level Starting battery level
     */
    public function __construct(int $level)
    {
        $this->level = $level;
    }


    /**
     * Drains battery level.
     * @param int $step Step for battery drain
     * @return bool Has been drain successful?
     */

    public function drain(int $step): bool
    {
        // Only when there is enough charge, it drains...
        if ($this->isCharged($step)) {
            $this->level -= $step;
            return true;
        } else {
            return false;
        }
    }


    /**
     * Does battery contain enough charge for drain?
     * @param int $threshold Desired step for drain
     * @return bool Is battery charged enough?
     */

    public function isCharged(int $threshold = 0)
    {
        return $this->level >= $threshold;
    }
}