<?php

/**
 * Glorious Roomba.
 * @class Roomba
 * @author Jakub Rychecký <jakub@rychecky.cz>
 */

class Roomba
{

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
     * @var Recorder $recorder Recorder for Roomba history
     */
    public $recorder;


    /**
     * Roomba constructor.
     * @param Commander $commander Commander for Roomba
     * @param Navigator $navigator Navigator with map inside for roomba
     * @param Battery   $battery Battery for Roomba
     */

    public function __construct(Commander $commander, Navigator $navigator, Battery $battery)
    {
        $this->commander = $commander;
        $this->navigator = $navigator;
        $this->battery = $battery;

        // Initialize recorder with the first record
        $this->recorder = new Recorder();
        $this->record('START');
    }


    /**
     * Makes one record for executed command.
     * @param string $command Executed command
     * @param bool   $hit Roomba hit the wall?
     * @return void
     */
    public function record(string $command, bool $hit = false): void
    {
        $this->recorder->addRecord($command, $this, $hit);
    }

}