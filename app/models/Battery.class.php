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
     * Provides battery cost for desired command.
     * @param string $command Command
     * @return int Battery cost
     */

    static function cost($command): int
    {
        $cost = [
            'TL' => 1,
            'TR' => 1,
            'A' => 2,
            'B' => 3,
            'C' => 5
        ];

        return (int)$cost[$command];
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


    /**
     * Is the battery charged enough to initialize backoff strategy?
     * @return bool Is charged for back off?
     */

    public function isChargedForBackoff(): bool
    {
        // The first command of the first backoff state
        $command = Command::backoff(0)[0];

        // Is battery charged to initialize backoff?
        return $this->isCharged(Battery::cost($command));
    }

}