<?php

/**
 * Glorious Roomba.
 * @class Roomba
 * @author Jakub Rychecký <jakub@rychecky.cz>
 */

class Roomba
{
    /**
     * @var array Loaded JSON data and parsed into an array
     */
    public $loaded;

    /**
     * @var Navigator $navigator Roomba's sense in the room
     */
    public $navigator;

    /**
     * @var Battery $battery Roomba battery
     */
    public $battery;


    /**
     * Roomba constructor.
     * @param String $filepath Filepath to load init JSON
     */

    public function __construct(String $filepath)
    {
        $this->loaded = JSON::load($filepath);

        $this->initBattery();
        $this->initNavigator();
    }


    /**
     * Creates Roomba's battery.
     */

    private function initBattery(): void
    {
        $this->battery = new Battery($this->loaded['battery']);
    }


    /**
     * Creates Navigator inside Roomba's brain.
     */

    private function initNavigator(): void
    {
        // Map of the room
        $map = new Map($this->loaded['map']);

        // Starting position
        $start = &$this->loaded['start'];
        $position = new Position($start['X'], $start['Y'], $start['facing']);

        // Instance of Navigator
        $this->navigator = new Navigator($map, $position);
    }


    /**
     * Executes the command.
     * @param string $command Command
     */

    public function execute(string $command)
    {
        // @TODO Refactor this into commander class
        if ($command == 'TL') {
            $this->navigator->turnLeft();
            $this->battery->drain(1);
        } elseif ($command == 'TR') {
            $this->navigator->turnRight();
            $this->battery->drain(1);
        } elseif ($command == 'A') {
            $this->navigator->advance();
            $this->battery->drain(2);
        } elseif ($command == 'B') {
            // @TODO Back command
            $this->battery->drain(3);
        } elseif ($command == 'C') {
            $this->navigator->clean();
            $this->battery->drain(5);
        }
    }


}