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
    public $data;

    /**
     * @var Navigator $navigator Roomba's sense in the room
     */
    public $navigator;

    /**
     * @var Battery $battery Roomba battery
     */
    public $battery;

    /**
     * @var Commander Queue for Roomba commands
     */
    public $commander;


    /**
     * Roomba constructor.
     * @param string $data_json Input data
     */

    public function __construct(string $data_json)
    {
        $this->data = json_decode($data_json, true);

        $this->initBattery();
        $this->initNavigator();
        $this->initCommander();
    }


    /**
     * Creates Roomba's battery.
     */

    protected function initBattery(): void
    {
        $this->battery = new Battery($this->data['battery']);
    }


    /**
     * Creates Navigator inside Roomba's brain.
     */

    protected function initNavigator(): void
    {
        // Map of the room
        $map = new Map($this->data['map']);

        // Starting position
        $start = &$this->data['start'];
        $position = new Position($start['X'], $start['Y'], $start['facing']);

        // Instance of Navigator
        $this->navigator = new Navigator($map, $position);
    }


    /**
     *  Initializes commander for Rooomba.
     */

    protected function initCommander(): void
    {
        $this->commander = new Commander($this->data['commands']);
    }

}