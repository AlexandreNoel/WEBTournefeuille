<?php
    require '../vendor/autoload.php';
?>

<!DOCTYPE html>
<html>  
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta   http-equiv="X-UA-Compatible" content="IE=edge">
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
        <nav class="navbar navbar-expand-md navbar-dark fixed-top" id="navbarD">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand" href="index.php"><img id="img-navbar" src="assets/images/logo_sf.png"></a>

                <!-- BANNIERE ACCUEIL !-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="home.php">Accueil</a>
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
                    <button type="button" class="btn text-dark btn-banner hvr-wobble-horizontal">Connecte toi</button>
                </div>
            </div>
        </div>

        <!-- BANNIERE CATALOGUE !-->
        <div class="banner-catalogue">
            <div class="container">
                <div class="banner-text">
                    <div class="banner-heading">
                        Consulte notre catalogue   <i class="fa fa-beer"></i>  
                    </div>
                    <div class="banner-sub-heading">
                        <br>
                    </div>
                    <button type="button" class="btn text-dark btn-banner">Catalogue</button>
                </div>
            </div>
        </div>


        <section id="about">
            <div class="container">
                <div class="text-intro">
                    <h4>Nous contacter</h4>
                    <p>Email: lebard@ensiie.fr</p>
                </div>
            </div>
        </section>


        <!-- JAVASCRIPT -->
        <script>
            $(document).on("scroll", function(){
                if($(document).scrollTop() > 86){
                    $("#navbarD").addClass("fixed-nav");
                    $(".nav-link").addClass("fixed-nav-text");
                    $("#img-navbar").attr("src","assets/images/logo_sf_blanc.png");
                }
                else{
                    $("#navbarD").removeClass("fixed-nav");
                    $(".nav-link").removeClass("fixed-nav-text");
                    $("#img-navbar").attr("src","assets/images/logo_sf.png");
                }
            });
            $(document).on("scroll", function(){
                if($(document).scrollTop() > 86){
                    $("#navbarD").addClass("fixed-nav");
                    $(".nav-link").addClass("fixed-nav-text");
                    $("#img-navbar").attr("src","assets/images/logo_sf_blanc.png");
                }
                else{
                    $("#navbarD").removeClass("fixed-nav");
                    $(".nav-link").removeClass("fixed-nav-text");
                    $("#img-navbar").attr("src","assets/images/logo_sf.png");
                }
            });
        </script>
    </body>

</html>