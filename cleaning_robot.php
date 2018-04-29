<?php

// Roomba needs bootstrap for a life
require_once 'bootstrap.php';


if (!empty($argv[1])) {
    // Input filepath in parameters
    $roomba = new Roomba(file_get_contents($argv[1]));
} else {
    // No input filepath leads to $_POST
    $roomba = new Roomba($_POST['data']);
}


// Roomba executes commands until it can
while ($roomba->commander->hasCommands()) {
    $command = $roomba->commander->getCommand();
    $roomba = Command::$command($roomba);
}


// Output filepath parameter leads to save JSON file
if (!empty($argv[2])) {
    Output::save($argv[2], Output::json($roomba));
}

echo Output::json($roomba);