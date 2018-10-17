<?php
require '../vendor/autoload.php';

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

        <title>TEST ACCUEIL</title>

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/bard_main.css">
    </head>

    <body>

        <!-- NAVBAR !-->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top" id="banner">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand" href="#"><img id="img-navbar" src="assets/logo_sf.png" style="width:75px;">Bar <span>D</span></a>

                <!-- BANNIERE ACCUEIL !-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Catalogue</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Se connecter</a>
                        </li> 
                    </ul>
                </div>
            </div>
        </nav>

        <!-- BANNIERE ACCUEIL !-->
        <div class="banner">
            <div class="container">
                <div class="banner-text">
                    <div class="banner-heading">
                        Le bar digital vous ouvre ses portes
                    </div>
                    <div class="banner-sub-heading">
                        ENSIIE - EVRY
                    </div>
                    <button type="button" class="btn btn-warning text-dark btn-banner">Connecte toi</button>
                </div>
            </div>
        </div>


        <section id="about">
        <div class="container">
            <div class="text-intro">
            <h2>Nous contacter</h2>
                <p>Viens donc nous voir ! </p>
            </div>
        </div>
        </section>


        <!-- JAVASCRIPT -->
        <script>
            $(document).on("scroll", function(){
                if($(document).scrollTop() > 86){
                    $("#banner").addClass("shrink");
                    $("#img-navbar").attr("src","assets/logo_sf_blanc.png");
                }
                else{
                    $("#banner").removeClass("shrink");
                    $("#img-navbar").attr("src","assets/logo_sf.png");
                }
            });
        </script>
    </body>

</html>