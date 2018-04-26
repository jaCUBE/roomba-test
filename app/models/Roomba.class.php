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

    protected function initBattery(): void
    {
        $this->battery = new Battery($this->loaded['battery']);
    }


    /**
     * Creates Navigator inside Roomba's brain.
     */

    protected function initNavigator(): void
    {
        // Map of the room
        $map = new Map($this->loaded['map']);

        // Starting position
        $start = &$this->loaded['start'];
        $position = new Position($start['X'], $start['Y'], $start['facing']);

        // Instance of Navigator
        $this->navigator = new Navigator($map, $position);
    }


}