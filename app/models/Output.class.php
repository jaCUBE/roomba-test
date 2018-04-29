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
        // JSON_PRETTY_PRINT
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
        foreach ($roomba->recorder->getVisited() as $record) {
            $export['visited'][] = $record->output();
        }

        // Cleaned positions
        foreach ($roomba->recorder->getCleaned() as $record) {
            $export['cleaned'][] = $record->output();
        }

        // Final position
        $export['final'] = [
            'X' => $roomba->navigator->position->x,
            'Y' => $roomba->navigator->position->y,
            'facing' => $roomba->navigator->position->facing
        ];

        // Battery level
        $export['battery'] = $roomba->battery->level;

        // $export['history'] = $roomba->commander->history;

        return $export;
    }


    /**
     * Saves output to the JSON file.
     * @param string $filepath File destination
     * @param string $content JSON content
     */

    static function save(string $filepath, string $content)
    {
        $fp = fopen($filepath, 'w');
        fwrite($fp, $content);
        fclose($fp);
    }

}