<?php
/**
 * Created by PhpStorm.
 * User: jaCUBE
 * Date: 26.04.2018
 * Time: 16:59
 */

class Navigator
{
    /**
     * @var Map Map of the room
     */
    public $map;

    /**
     * @var Position Current robot position
     */
    public $position;

    /**
     * @var Position[] List of visited position
     */
    public $history = [];





    /**
     * Navigator constructor.
     * @param Map      $map
     * @param Position $position
     */

    public function __construct(Map $map, Position $position)
    {
        $this->map = $map;
        $this->position = $position;
        $this->addVisited();
    }


    public function turnRight()
    {
        $rotate = ['N' => 'E', 'E' => 'S', 'S' => 'W', 'W' => 'N'];
        $this->position->facing = $rotate[$this->position->facing];
    }

    public function turnLeft()
    {
        $rotate = ['N' => 'W', 'W' => 'S', 'S' => 'E', 'E' => 'N'];
        $this->position->facing = $rotate[$this->position->facing];
    }

    private function advanceDestinationX(){
        if ($this->position->facing == 'E') {
            return $this->position->x + 1;
        } elseif ($this->position->facing == 'W') {
            return $this->position->x - 1;
        }else{
            return $this->position->x;
        }
    }

    private function advanceDestinationY(){

        if ($this->position->facing == 'N') {
            return $this->position->y - 1;
        }elseif ($this->position->facing == 'S') {
            return $this->position->y + 1;
        }else{
            return $this->position->y;
        }
    }

    public function advance()
    {
        if($this->isAdvancePossible()){
            // Updates current position with designed coordination
            $this->position = new Position($this->advanceDestinationX(), $this->advanceDestinationY(), $this->position->facing);
            $this->addVisited();
        }
    }

    public function isAdvancePossible(): bool {
        $destination_x = $this->advanceDestinationX();
        $destination_y = $this->advanceDestinationY();
        return $this->map->isFree($destination_x, $destination_y);
    }


    private function addVisited()
    {
        $position_current = clone $this->position;
        $this->history = array_merge([$position_current], $this->history);
    }





}