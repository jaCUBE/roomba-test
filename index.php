<?php require_once 'bootstrap.php'; ?>
<!DOCTYPE html>


<html lang="cs">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="gui-tab" data-toggle="tab" href="#gui" role="tab">
                    <i class="fa fa-star"></i> GUI
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="api-tab" data-toggle="tab" href="#api" role="tab">
                    <i class="fa fa-code"></i> API
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="structure-tab" data-toggle="tab" href="#structure" role="tab">
                    <i class="fa fa-sitemap"></i> Structure
                </a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="gui" role="tabpanel"><?php include 'app/views/gui.php' ?></div>
            <div class="tab-pane fade" id="api" role="tabpanel"><?php include 'app/views/api.php' ?></div>
            <div class="tab-pane fade" id="structure" role="tabpanel"><?php include 'app/views/structure.php' ?></div>
        </div>
    </main>
    <footer>
        <a href="https://github.com/jaCUBE/roomba-test" class="btn btn-sm btn-dark">
            <i class="fa fa-github"></i> GitHub
        </a>

        • rychecky 2018
    </footer>
</div>
</body>
</html>