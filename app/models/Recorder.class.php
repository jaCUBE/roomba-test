<?php

/**
 * Records, filters and manages glorious history of Roomba.
 * @class Recorder
 * @author Jakub Rychecký <jakub@rychecky.cz>
 */


class Recorder
{
    /**
     * @var Record[] $records
     */
    public $records = [];


    /**
     * Adds one record into the history.
     * @param string   $command Executed command
     * @param Position $position Current position
     */
    public function addRecord(string $command, Position $position): void
    {
        $this->records[] = new Record($command, $position);
    }


    /**
     * Filters records visited by Roomba.
     * @return Record[] Visited records
     */

    public function getVisited(): array
    {
        return $this->getByCommands(['A', 'B', 'START']);
    }

    /**
     * Filters records by given commands.
     * @return Record[] Filtered records
     */

    public function getByCommands(array $commands_filter)
    {
        $output = [];

        // Browse each record and filter them
        foreach ($this->records as $record) {
            if (in_array($record->command, $commands_filter)) {
                $output[] = $record;
            }
        }

        // Final array touch
        return $this->finishArray($output);
    }

    /**
     * Provides final beautification and trimming.
     * @param Record[] $array Array for records
     * @return Record[] Filtered array of records
     */

    private function finishArray(array $array): array
    {
        $output = [];

        // X, Y creates key and therefore, the record will be unique for coord
        foreach ($array as $record) {
            $output[$record->x . ', ' . $record->y] = $record;
        }

        // Remove unique keys and reverse the order
        return array_reverse(array_values($output));
    }

    /**
     * Filters records cleaned by Roomba.
     * @return Record[] Cleaned records
     */

    public function getCleaned(): array
    {
        return $this->getByCommands(['C']);
    }


}