<?php if (class_exists('Kint_Renderer')): ?>
    <h2>Structure of Roomba for test2.json</h2>
    <?php

    $data = json_decode(file_get_contents('resources/data/test2.json'), true);
    $roomba = RoombaFactory::makeRoomba($data);

    ?>

    At the start: <?php d($roomba); ?>

    <?php
    // Roomba executes commands until it can
    while ($roomba->commander->hasCommands()) {
        $command = $roomba->commander->getCommand();
        $roomba = Command::$command($roomba);
        /** @var $roomba Roomba */
    }
    ?>

    At the end: <?php d($roomba); ?>

    <div class="alert alert-info">
        <i class="fa fa-info-circle"></i> Click to expand.
    </div>
<?php endif; ?>