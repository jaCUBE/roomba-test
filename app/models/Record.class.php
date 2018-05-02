<?php

/**
 * One record in Roomba wonderful history.
 * @class Record
 * @author Jakub Rychecký <jakub@rychecky.cz>
 */

class Record
{

    /**
     * @var string $command Executed command
     */
    public $command;

    /**
     * @var Position $position Position in this point of the history
     */
    public $position;

    /**
     * @var Commander $commander Commander in this point of the history
     */
    public $commander;

    /**
     * @var Battery $battery Battery in this point of the history
     */
    public $battery;

    public $hit;


    /**
     * Record constructor.
     * @param string $command Executed command
     * @param Roomba $roomba Roomba itself
     * @param bool   $hit Roomba hit the wall?
     */

    public function __construct(string $command, Roomba $roomba, bool $hit)
    {
        $this->command = $command;
        $this->hit = $hit;

        // It rips objects needed by history record from poor Roomba bot
        // @TODO I guess I can do virtually whole Roomba snapshots now :)
        $this->position = clone $roomba->navigator->position;
        $this->commander = clone $roomba->commander;
        $this->battery = clone $roomba->battery;
    }


    /**
     * Gives formatted date for output.
     * @return array Formatted X and Y coords
     */

    public function output()
    {
        return [
            'X' => $this->position->x,
            'Y' => $this->position->y
        ];
    }


    /**
     * Is this history record a hit?
     * @return bool
     */

    public function isHit(): bool
    {
        return (bool)$this->hit;
    }

}