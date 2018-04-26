<?php

/**
 * Provides methods for loading/saving JSON files.
 * @class JSON
 * @author Jakub Rychecký <jakub@rychecky.cz>
 */

class JSON
{
    /**
     * Loads JSON file with initial data.
     * @param string $filepath Path to JSON file
     * @return array Returns parsed content in array
     */
    static function load(string $filepath): array
    {
        $json = file_get_contents($filepath);
        return json_decode($json, true);
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