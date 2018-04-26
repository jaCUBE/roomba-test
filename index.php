<!DOCTYPE html>


<html lang="cs">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/superhero/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="css/roomba.css"></script>

</head>
<body>
<div class="container">
    <?php

    require_once 'bootstrap.php';

    $r = new Roomba('resources/test1.json');
    JSON::save('resources/output1.json', Output::json($r));

    $r = new Roomba('resources/test2.json');
    JSON::save('resources/output2.json', Output::json($r));

    d($r);

    foreach ($r->loaded['commands'] as $command) {
        $r->execute($command);
        d($command);
        d($r->navigator->position);
    }


    $p = new Position(3, 0, 'N');
    d($p);
    d($p->buildAdvancePosition());
    d($p);

    ?>
</div>


</body>
</html>
