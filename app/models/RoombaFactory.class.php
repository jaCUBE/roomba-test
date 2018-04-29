<?php

/**
 * Factory for new shiny Roombas.
 * @class RoombaFactory
 * @author Jakub Rychecký <jakub@rychecky.cz>
 */

class RoombaFactory
{

    /**
     * Makes Roomba instance from initial data.
     * @param array $init Init data
     * @return Roomba
     */

    static function makeRoomba($init): Roomba
    {
        // Commander with commands
        $commander = new Commander($init['commands']);

        // Instance of map
        $map = new Map($init['map']);

        // Starting position
        $start = &$init['start'];
        $position = new Position($start['X'], $start['Y'], $start['facing']);

        // Instance of Navigator
        $navigator = new Navigator($map, $position);

        // Battery for Roomba
        $battery = new Battery($init['battery']);

        // Roomba leaves factory! Yay!
        return new Roomba($commander, $navigator, $battery);
    }


}