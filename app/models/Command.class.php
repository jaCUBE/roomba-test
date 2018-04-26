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
        $roomba->navigator->turnLeft();
        $roomba->battery->drain(1);

        return $roomba;
    }

    /**
     * Turn right.
     * @param Roomba $roomba Roomba
     * @return Roomba Roomba after a command
     */
    static function TR(Roomba $roomba): Roomba
    {
        $roomba->navigator->turnRight();
        $roomba->battery->drain(1);

        return $roomba;
    }

    /**
     * Advance in direction.
     * @param Roomba $roomba Roomba
     * @return Roomba Roomba after a command
     */
    static function A(Roomba $roomba): Roomba
    {
        $roomba->navigator->advance();
        $roomba->battery->drain(2);
        return $roomba;
    }

    /**
     * Go back.
     * @param Roomba $roomba Roomba
     * @return Roomba Roomba after a command
     */
    static function B(Roomba $roomba): Roomba
    {
        // @TODO Back command
        $roomba->battery->drain(3);
        return $roomba;
    }


    /**
     * Perform cleaning.
     * @param Roomba $roomba Roomba
     * @return Roomba Roomba after a command
     */

    static function C(Roomba $roomba): Roomba
    {
        $roomba->navigator->clean();
        $roomba->battery->drain(5);
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