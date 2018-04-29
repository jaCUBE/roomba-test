<?php $api = json_decode(file_get_contents('resources/data/test1.json'), true) ?>

<form class="api" action="post">
    <b>Map:</b>
    <table class="map">
        <?php for ($x = 0; $x < 4; $x++) { ?>
            <tr>
                <?php for ($y = 0; $y < 4; $y++) { ?>
                    <td>
                        <input type="text" class="form-control"
                               name="map[<?= $x ?>][<?= $y ?>]"
                               value="<?= $api['map'][$x][$y] ?>"/>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>

    <b>Commands:</b>
    <table class="commands">
        <tr>
            <?php for ($i = 0; $i < count($api['commands']); $i++) { ?>
                <td>
                    <input type="text" class="form-control" name="commands[]"
                           value="<?= $api['commands'][$i] ?>"/>
                </td>
            <?php } ?>
        </tr>
    </table>

    <div class="row">
        <div class="col-md-8">
            <b>Start:</b>
            <table class="start">
                <tr>
                    <td>
                        <input type="text" class="form-control" name="start[X]"
                               value="<?= $api['start']['X'] ?>" placeholder="X"/>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="start[Y]"
                               value="<?= $api['start']['Y'] ?>" placeholder="Y"/>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="start[facing]"
                               value="<?= $api['start']['facing'] ?>" placeholder="facing"/>
                    </td>
                </tr>
            </table>
        </div>


        <div class="col-md-4">
            <b>Battery:</b>
            <input type="text" class="form-control" name="battery"
                   value="<?= $api['battery'] ?>"/>
        </div>

    </div>
</form>


<div class="submit-button">
    <div class="btn btn-primary" onclick="api()">
        Test API call
    </div>
</div>


<br/><br/>

<label for="output-api">Output JSON for API call:</label>
<textarea name="output-api" class="form-control output-api" readonly></textarea>


<div class="alert alert-info">
    <i class="fa fa-info-circle"></i> Calls <b>cleaning_bot.php</b> through POST.
</div>