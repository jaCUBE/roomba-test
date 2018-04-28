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
        }

        return $roomba;
    }

    /**
     * Gets battery cost for command.
     * @param string $command Command
     * @return int Battery cost
     */

    static function batteryCost(string $command): int
    {
        return (int)@self::$battery_cost[$command];
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
            $roomba->navigator->clean();
            $roomba->battery->drain(Battery::cost('C'));
        }

        return $roomba;
    }


    /**
     * Ba
     * @return array
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

        return $backoff[$state];
    }

}