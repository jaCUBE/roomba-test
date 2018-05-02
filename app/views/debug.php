<?php $filepath = $_GET['filepath'] ?? 'resources/data/test1.json'; ?>


<?php if (class_exists('Kint_Renderer')): // Only if PHP Kint is installed via Composer ?>
    <div class="row">
        <div class="col-md-6">
            <h3><i class="fa fa-flag"></i> <?= $filepath ?> start</h3>
            <?php $data = json_decode(file_get_contents($filepath), true);
            $roomba = RoombaFactory::makeRoomba($data); ?>
            <?php d($roomba); ?>
        </div>

        <div class="col-md-6">
            <h3><i class="fa fa-flag-checkered"></i> <?= $filepath ?> finish</h3>
            <?php
            // Roomba executes commands until it can
            while ($roomba->commander->hasCommands()) {
                $command = $roomba->commander->getCommand();
                $roomba = Command::$command($roomba);
                /** @var $roomba Roomba */
            }
            ?>

            <?php d($roomba); ?>
        </div>
    </div>

    <hr/>
<?php endif; ?>



<?php foreach (scandir('resources/data') as $item) {
    if (strpos($item, 'json') === false) {
        continue;
    } ?>

    <form action="" method="get">
        <input type="hidden" name="filepath" value="resources/data/<?= $item ?>"/>

        <button type="submit" class="btn btn-sm btn-dark">
            <i class="fa fa-bug"></i> Debug <?= $item ?>
        </button>
    </form>
<?php } ?>


<table class="records">
    <?php foreach ($roomba->recorder->records as $i => $record) { ?>
        <tr>
            <td>Command</td>
            <td><span class="badge badge-dark"><?= $i ?></span></td>

            <td>is&hellip;</td>

            <td style="text-align: right">
                <?php if ($record->commander->backoff_state) { // Red label for BACKOFF ?>
                    <span class="badge badge-danger">B<?= $record->commander->backoff_state ?></span>
                <?php } ?>
                <span class="badge badge-info"><?= $record->command // Executed command  ?></span>
            </td>

            <td>&hellip;after execution, robot ends at</td>

            <td>
                <span class="badge badge-primary"><?= $record->position->x ?>, <?= $record->position->y ?></span>
            </td>

            <td>facing</td>

            <td>
                <span class="badge badge-secondary"><?= $record->position->facing ?></span>
            </td>

            <td>with batter level at</td>

            <td>
                <span class="badge badge-light"><?= $record->battery->level ?></span>
            </td>
        </tr>
    <?php } ?>
</table>