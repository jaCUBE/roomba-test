<?php
/**
 * Created by PhpStorm.
 * User: jaCUBE
 * Date: 26.04.2018
 * Time: 16:09
 */

class Roomba
{
    public $filepath_input;
    public $filepath_output;
    public $data_input;
    public $data_output;

    public $navigator;
    public $battery;


    public function __construct(String $filepath_input, string $filepath_output)
    {
        $this->filepath_input = $filepath_input;
        $this->filepath_output = $filepath_output;
        $this->data_input = JSON::load($this->filepath_input);

        $this->initBattery();
        $this->initNavigator();
    }

    private function initBattery()
    {
        $this->battery = new Battery($this->data_input['battery']);
    }

    private function initNavigator()
    {
        $map = new Map($this->data_input['map']);
        $start = &$this->data_input['start'];
        $position = new Position($start['X'], $start['Y'], $start['facing']);

        $this->navigator = new Navigator($map, $position);
    }

    public function execute(string $command)
    {
        if ($command == 'TL') {
            $this->navigator->turnLeft();
            $this->battery->drain(1);
        } elseif ($command == 'TR') {
            $this->navigator->turnRight();
            $this->battery->drain(1);
        } elseif ($command == 'A') {
            $this->navigator->advance();
            $this->battery->drain(2);
        }elseif ($command == 'B'){
            $this->battery->drain(3);
        }elseif($command == 'C'){
            $this->battery->drain(5);
        }
    }


    public function output(){
        $export = [];

        foreach($this->navigator->history as $position){
            $export['visited'][] = $position->toArray();
        }

        $export['final'] = $this->navigator->position->toArray();
        $export['battery'] = $this->battery->current();

        return $export;
    }

}