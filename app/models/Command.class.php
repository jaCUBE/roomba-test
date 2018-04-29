<?php

/**
 * Commands for Roomba.
 * @class Command
 * @author Jakub Rychecký <jakub@rychecky.cz>
 */

class Command
{

    /**
     * Turn left.
     * @param Roomba $roomba Roomba
     * @return Roomba Roomba after a command
     */
    static function TL(Roomba $roomba): Roomba
    {
        // Turns left only with enough battery
        if ($roomba->battery->isCharged(Battery::cost('TL'))) {
            $roomba->navigator->turnLeft();
            $roomba->battery->drain(Battery::cost('TL'));
            $roomba->record('TR');
        }

        return $roomba;
    }

    /**
     * Turn right.
     * @param Roomba $roomba Roomba
     * @return Roomba Roomba after a command
     */
    static function TR(Roomba $roomba): Roomba
    {
        // Turns right only with enough battery
        if ($roomba->battery->isCharged(Battery::cost('TR'))) {
            $roomba->navigator->turnRight();
            $roomba->battery->drain(Battery::cost('TR'));
            $roomba->record('TR');
        }

        return $roomba;
    }

    /**
     * Advance in direction.
     * @param Roomba $roomba Roomba
     * @return Roomba Roomba after a command
     */
    static function A(Roomba $roomba): Roomba
    {
        // Performs advance only with enough battery
        if ($roomba->battery->isCharged(Battery::cost('A'))) {
            // Tries to advance, if obstacle, raise back off strategy into command queue
            if ($roomba->navigator->advance()) {
                // Roomba has clear space, advance successful, clear back off
                $roomba->commander->resetBackOff();
                $roomba->record('A');
            } else {
                // Roomba hits something, time for back off
                $roomba->commander->addBackOff();
            }

            $roomba->battery->drain(Battery::cost('A'));
        }

        return $roomba;
    }

    /**
     * Go back.
     * @param Roomba $roomba Roomba
     * @return Roomba Roomba after a command
     */
    static function B(Roomba $roomba): Roomba
    {
        // Goes back only with enough battery
        if ($roomba->battery->isCharged(Battery::cost('B'))) {
            $roomba->navigator->back();
            $roomba->battery->drain(Battery::cost('B'));
            $roomba->record('B');
        }

        return $roomba;
    }


    /**
     * Perform cleaning.
     * @param Roomba $roomba Roomba
     * @return Roomba Roomba after a command
     */

    static function C(Roomba $roomba): Roomba
    {
        // Cleans only with enough battery
        if ($roomba->battery->isCharged(Battery::cost('C'))) {
            $roomba->battery->drain(Battery::cost('C'));
            $roomba->record('C');
        }

        return $roomba;
    }


    /**
     * Provides back off strategy for desired state.
     * @param int $state Back off strategy state (0-4)
     * @return array Array of commands for back off strategy
     */
    static function backoff(int $state = 0): array
    {
        $backoff = [
            ['TR', 'A'],
            ['TL', 'B', 'TR', 'A'],
            ['TL', 'TL', 'A'],
            ['TR', 'B', 'TR', 'A'],
            ['TL', 'TL', 'A']
        ];

        return @$backoff[$state];
    }


    /**
     * Provides the list of possible commands.
     * @return array Possible commands
     */

    static function list()
    {
        return ['A', 'B', 'C', 'TR', 'TL'];
    }

}