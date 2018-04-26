<?php

/**
 * Output takes care about exporting Roomba state in desired format.
 * @class Output
 * @author Jakub Rychecký <jakub@rychecky.cz>
 */

class Output
{

    /**
     * Creates JSON output for Roomba state.
     * @param Roomba $roomba Roomba itself
     * @return string JSON of Roomba state
     */
    static function json(Roomba $roomba)
    {
        return json_encode(Output::array($roomba), JSON_PRETTY_PRINT);
    }


    /**
     * Creates array output for Roomba state.
     * @param Roomba $roomba Roomba itself
     * @return string Array of Roomba state
     */
    static function array(Roomba $roomba)
    {
        $export = [];

        // Visited positions
        foreach ($roomba->navigator->visited as $position) {
            $export['visited'][] = [
                'X' => $position->x,
                'Y' => $position->y
            ];
        }

        // Cleaned
        foreach ($roomba->navigator->cleaned as $position) {
            $export['cleaned'][] = [
                'X' => $position->x,
                'Y' => $position->y
            ];
        }

        // Final position
        $export['final'] = [
            'X' => $roomba->navigator->position->x,
            'Y' => $roomba->navigator->position->y,
            'facing' => $roomba->navigator->position->facing
        ];

        // Battery level
        $export['battery'] = $roomba->battery->level;

        return $export;
    }

}