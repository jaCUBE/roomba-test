<?php

/**
 * One record in Roomba wonderful history.
 * @class Recorder
 * @author Jakub Rychecký <jakub@rychecky.cz>
 */

class Record
{
    /**
     * @var int $x Coordination in axis X
     */
    public $x;

    /**
     * @var int $y Coordination in axis Y
     */
    public $y;

    /**
     * @var string $facing Facing
     */
    public $facing;

    /**
     * @var string $command Executed command
     */
    public $command;


    /**
     * Record constructor.
     * @param string   $command Executed command
     * @param Position $position Current position
     */

    public function __construct(string $command, Position $position)
    {
        $this->command = $command;

        // Deconstruction of position
        // @TODO Or maybe to leave Position whole object?
        $this->x = $position->x;
        $this->y = $position->y;
        $this->facing = $position->facing;
    }


    /**
     * Gives formatted date for output.
     * @return array Formatted X and Y coords
     */

    public function output()
    {
        return ['X' => $this->x, 'Y' => $this->y];
    }

}