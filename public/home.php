<?php
    require '../vendor/autoload.php';
    include '../module/src/User/Repository/UserRepository.php';

//postgres
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    $username = "Sphinx06";
    $userFullName = "Xavier GRIMALDI";
?>

<!DOCTYPE html>
<html>  

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicon.ico">
        <title>Le Bar D - Accueil</title>

        <!-- Ressources -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <!-- Font Awesome JS -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
        <!-- Css -->
        <link rel="stylesheet" href="css/bard_main.css">
    </head>

    <body>
        <!-- NAVBAR !-->
        <?php include_once('./view/navbar.php'); ?>
        
        <!-- CONTENU !-->
        <div class="content-container">

            <div class="grid-container pr-3 pl-3">
                <div class="Actualité grid-block">
                    <div class="wrapper">
                        <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#newsCarousel" data-slide-to="0" class=""></li>
                                <li data-target="#newsCarousel" data-slide-to="1" class="active"></li>
                                <li data-target="#newsCarousel" data-slide-to="2" class=""></li>
                            </ol>

                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item">
                                    <img class="d-block mx-auto img-fluid" src="assets/images/articles/art1.jpg" alt="">
                                    <div class="carousel-caption">
                                        <h3>La pinte de Noel</h3>
                                        <p>Papa noël</p>
                                    </div>
                                </div>
                                <div class="carousel-item active">
                                    <img class="d-block mx-auto img-fluid" src="assets/images/articles/art1.jpg" alt="">
                                    <div class="carousel-caption">
                                        <h3>NJV BEUVERIE</h3>
                                        <p>Soon</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block mx-auto img-fluid" src="assets/images/articles/art1.jpg" alt="">
                                    <div class="carousel-caption">
                                        <h3>Yes</h3>
                                        <p>C'est beau</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="Catalogue grid-block">
                    <a href="/catalogue.php">
                        <div class="container h-100">
                            <div class="row h-100 justify-content-center align-items-center">
                                <div class="col-12 mx-auto">
                                    <h3>Catalogue</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="Compte grid-block">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-base">
                                    <div class="card-icon"><a href="#" title="Widgets" id="widgetCardIcon" class="imagecard"><span class="fa fa-user"></span></a>
                                        <div class="card-data widgetCardData">
                                            <h2 class="box-title pb-0" style="color: #bb7824;"><?php echo $username?> </h2>
                                            <h6 class="box-title pt-0" style="color: #bb7824;"><?php echo $userFullName?></h6>
                                            <p class="card-block text-center">
                                                Mon compte
                                                <br>
                                                Solde: 25€
                                            </p>
                                            <a href="stats.php" title="Mes statistiques" class="anchor btn btn-default"> <i class="fa fa-chart-bar" aria-hidden="true"></i>Mes statistiques </a>
                                            <a href="transactions.php" title="Mes transactions" class="anchor btn btn-default"> <i class="fa fa-chart-bar" aria-hidden="true"></i> Mes transactions </a>
                                        </div>
                                    </div>
                                    <div class="space"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="footer">

        </div>

    </body>

</html>
    