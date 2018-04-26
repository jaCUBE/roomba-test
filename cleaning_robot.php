<?php

require_once 'bootstrap.php';

$r = new Roomba($_POST['data']);

foreach ($r->data['commands'] as $command) {
    $r = Command::$command($r);
}

echo Output::json($r);
// JSON::save('resources/my_output1.json', Output::json($r));