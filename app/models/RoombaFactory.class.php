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
     * @return Roomba Brand new Roomba just straight out of factory
     */

    static function makeRoomba($init): Roomba
    {
        // Gives Roomba a brain and self-preservation instinct
        $commander = new Commander($init['commands']);

        // Hic sunt leones
        $map = new Map($init['map']);

        // Birthplace
        $start = &$init['start'];
        $position = new Position($start['X'], $start['Y'], $start['facing']);

        // Gives Roomba sense of space
        $navigator = new Navigator($map, $position);

        // Plug in a battery in Roomba
        $battery = new Battery($init['battery']);

        // Roomba leaves factory! Yay!
        return new Roomba($commander, $navigator, $battery);
    }


}