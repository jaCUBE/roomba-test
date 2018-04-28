<?php require_once 'bootstrap.php'; ?>
<!DOCTYPE html>


<html lang="cs">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/roomba.css?v=<?= time() ?>">
    <script src="js/roomba.js?v=<?= time() ?>"></script>
</head>


<body>

<div class="container">
    <header>
        <h1>
            Roomba Test
        </h1>
    </header>


    <main>


        <form action="">
            <div class="row">
                <div class="col-md-6">
                    <label for="input">Input JSON:</label>
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


        Examples:
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
    </main>
    <footer></footer>
</div>
</body>
</html>