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

    $r = new Roomba('resources/my_test1.json');
    $r = Command::execute($r, ['A', 'A']);
    d($r);

    JSON::save('resources/my_output1.json', Output::json($r));

    ?>
</div>


</body>
</html>
