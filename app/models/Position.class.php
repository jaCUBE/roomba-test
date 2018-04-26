<?php
/**
 * Created by PhpStorm.
 * User: jaCUBE
 * Date: 26.04.2018
 * Time: 17:38
 */

class Position
{
    public function __construct($x, $y, $facing)
    {
        $this->x = $x;
        $this->y = $y;
        $this->facing = $facing;
    }

    public function toArray(){
        return ['X' => $this->x, 'Y' => $this->y];
    }
}