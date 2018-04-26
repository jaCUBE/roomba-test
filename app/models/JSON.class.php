<?php
/**
 * Created by PhpStorm.
 * User: jaCUBE
 * Date: 26.04.2018
 * Time: 16:15
 */

class JSON
{
    static function load(string $filename): array
    {
        $json = file_get_contents($filename);
        return json_decode($json, true);
    }
}