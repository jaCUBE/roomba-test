<?php

/**
 * Commands for Roomba.
 * @class Command
 * @author Jakub Rychecký <jakub@rychecky.cz>
 */

class Command
{

    /**
     * @var array Battery cost for every possible command
     */
    static public $battery_cost = [
        'TL' => 1,
        'TR' => 1,
        'A' => 2,
        'B' => 3,
        'C' => 5
    ];


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
     * Turn left.
     * @param Roomba $roomba Roomba
     * @return Roomba Roomba after a command
     */
    static function TL(Roomba $roomba): Roomba
    {
        // Turns left only with enough battery
        if ($roomba->battery->isCharged(Command::batteryCost('TL'))) {
            $roomba->navigator->turnLeft();
            $roomba->battery->drain(Command::batteryCost('TL'));
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
        if ($roomba->battery->isCharged(Command::batteryCost('TR'))) {
            $roomba->navigator->turnRight();
            $roomba->battery->drain(Command::batteryCost('TR'));
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
        if ($roomba->battery->isCharged(Command::batteryCost('A'))) {
            $roomba->navigator->advance();
            $roomba->battery->drain(Command::batteryCost('A'));
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
        if ($roomba->battery->isCharged(Command::batteryCost('B'))) {
            // @TODO Back command
            $roomba->battery->drain(Command::batteryCost('B'));
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
        if ($roomba->battery->isCharged(Command::batteryCost('C'))) {
            $roomba->navigator->clean();
            $roomba->battery->drain(Command::batteryCost('C'));
        }

        return $roomba;
    }


    /**
     * Performs list of commands.
     * @param Roomba $roomba Roomba
     * @param array  $command_list List of commands
     * @return Roomba Roomba after the commands
     */

    static function execute(Roomba $roomba, array $command_list): Roomba
    {
        // Performing each command
        foreach ($command_list as $command) {
            $roomba = Command::$command($roomba);
        }

        return $roomba;
    }

}