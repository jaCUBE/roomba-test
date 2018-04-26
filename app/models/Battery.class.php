<?php
/**
 * Created by PhpStorm.
 * User: jaCUBE
 * Date: 26.04.2018
 * Time: 16:36
 */

class Battery
{
    protected $level;

    public function __construct(int $level)
    {
        $this->level = $level;
    }

    public function drain(int $step): void
    {
        $this->level -= $step;
    }

    public function current(): int
    {
        return $this->level;
    }
}