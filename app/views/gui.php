<form action="">
    <div class="row">
        <div class="col-md-6">
            <label for="input">Input JSON (file content):</label>
            <textarea name="input" class="form-control input"></textarea>
        </div>
        <div class="col-md-6">
            <label for="output">Output JSON:</label>
            <textarea name="output" class="form-control output" readonly></textarea>
        </div>
    </div>
</form>

<div class="submit-button">
    <div class="btn btn-lg btn-primary" onclick="run()">
        Run!
    </div>
</div>

<hr/>

<h2>Examples:</h2>
<div class="examples btn-group">
    <?php foreach (scandir('resources/data') as $item) {
        if (strpos($item, 'json') === false) {
            continue;
        } ?>

        <div class="btn btn-sm btn-dark">
            <?= $item ?>
            <span class="content"><?= file_get_contents('resources/data/' . $item) ?></span>
        </div>
    <?php } ?>
</div>


<div class="alert alert-info">
    <i class="fa fa-info-circle"></i> Content of <b>/resources/data</b>.
</div>