<?php

// Roomba needs bootstrap for a life
require_once 'bootstrap.php';


// CLI/GUI/API
if (!empty($argv[1])) {
    // CLI: Input filepath as the first parameter
    $data = json_decode(file_get_contents($argv[1]), true);
} elseif (!empty($_POST['input'])) {
    // GUI: Input textarea from GUI
    $data = json_decode($_POST['input'], true);
} else {
    // API
    $data = $_POST;
}


// Roomba from the factory
$roomba = RoombaFactory::makeRoomba($data);

// Roomba executes commands until it can
while ($roomba->commander->hasCommands()) {
    $command = $roomba->commander->getCommand();
    $roomba = Command::$command($roomba);
}


// CLI: Output filepath parameter leads to save JSON file
if (!empty($argv[2])) {
    Output::save($argv[2], Output::json($roomba));
}


echo Output::json($roomba);