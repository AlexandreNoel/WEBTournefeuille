<?php
    require '../vendor/autoload.php';
    include '../module/src/User/Repository/UserRepository.php';

//postgres
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    $userRepository = new \User\UserRepository($connection);
    $users = $userRepository->fetchAll();
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
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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
                <div class="Actualité">
                    <h3>Actus</h3>
                    <div class="container">
                        <div class="row blog">
                            <div class="col-md-12">
                                <div id="blogCarousel" class="carousel slide" data-ride="carousel">

                                    <ol class="carousel-indicators">
                                        <li data-target="#blogCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#blogCarousel" data-slide-to="1"></li>
                                    </ol>

                                    <!-- Carousel items -->
                                    <div class="carousel-inner">

                                        <div class="carousel-item active">
                                            <div class="row align-items-center">
                                                <div class="col-md-6 ">
                                                    <a href="#">
                                                        <img src="assets/images/beer_catalogue.jpg" alt="Image" style="max-width:100%;">

                                                        <div class="carousel-caption d-none d-md-block">
                                                            <h5 class="font-weight-bold text-white">Incroyable</h5>
                                                            <p class="font-weight-bold text-white">Super</p>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-md-6">
                                                    <a href="#">
                                                        <img src="assets/images/beer_catalogue.jpg" alt="Image" style="max-width:100%;">

                                                        <div class="carousel-caption d-none d-md-block">
                                                            <h5 class="font-weight-bold text-white">Incroyable</h5>
                                                            <p class="font-weight-bold text-white">Super</p>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <!--.row-->
                                        </div>
                                        <!--.item-->

                                        <div class="carousel-item">
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <a href="#">
                                                        <img src="assets/images/beer_catalogue.jpg" alt="Image" style="max-width:100%;">

                                                        <div class="carousel-caption d-none d-md-block">
                                                            <h5 class="font-weight-bold text-white">Incroyable</h5>
                                                            <p class="font-weight-bold text-white">Super</p>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-md-6">
                                                    <a href="#">
                                                        <img src="assets/images/beer_catalogue.jpg" alt="Image" style="max-width:100%;">

                                                        <div class="carousel-caption d-none d-md-block">
                                                            <h5 class="font-weight-bold text-white">Incroyable</h5>
                                                            <p class="font-weight-bold text-white">Super</p>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <!--.row-->
                                        </div>
                                        <!--.item-->

                                    </div>
                                    <!--.carousel-inner-->
                                </div>
                                <!--.Carousel-->

                            </div>
                        </div>
                    </div>
                </div>
                <div class="Catalogue">
                    <h3>Catalogue</h3>
                </div>
                <div class="Compte">
                    <div class="container">
                        <div class = "row">
                            <div class = "col-md-12">
                                <div class="card-base">
                                    <div class="card-icon"><a href="#" title="Widgets" id="widgetCardIcon" class="imagecard"><span class="fa fa-user"></span></a>
                                        <div class="card-data widgetCardData">
                                            <h2 class="box-title" style="color: #bb7824;">John Doe Aka Pseudo</h2>
                                            <p class="card-block text-center">
                                                Mon compte
                                                <br>
                                                Solde: 25€
                                            </p>
                                            <a href="#" title="Mes statistiques" class="anchor btn btn-default" > <i class="fa fa-chart-bar" aria-hidden="true"></i>  Mes statistiques </a>
                                            <a href="#" title="Mes transactions" class="anchor btn btn-default" > <i class="fa fa-chart-bar" aria-hidden="true"></i>  Mes transactions </a>
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
    </body>

</html>
    