<?php
/**
 * Created by PhpStorm.
 * User: jaCUBE
 * Date: 26.04.2018
 * Time: 16:26
 */

class Map
{
    public $map = [];

    public function __construct(array $map)
    {
        $this->map = $map;
    }

    public function getStatus($x, $y)
    {
        return $this->map[$x][$y];
    }

    public function isFree($x, $y)
    {
        return @$this->getStatus($x, $y) !== null;
    }

    public function isCleanable($x, $y)
    {
        return $this->getStatus($x, $y) == 'S';
    }

}