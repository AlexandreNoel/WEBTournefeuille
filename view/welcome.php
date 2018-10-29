<!DOCTYPE html>
<html>

    <!-- NAVBAR !-->
    <?php require_once(__DIR__ . '/partials/header.php'); ?>

    <body>

        <!-- NAVBAR !-->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top" id="navbarD">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand" href="/"><img id="img-navbar" src="assets/images/logo_sf.png"></a>

                <!-- BANNIERE ACCUEIL !-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Actualités</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" >Catalogue</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- BANNIERE ACCUEIL !-->
        <div class="banner">
            <div class="container">
                <form method="POST" action="/login.php">
                    <div class="banner-text">
                        <div class="banner-heading">
                            Le bar digital vous ouvre ses portes
                        </div>
                        <div class="banner-sub-heading">
                            ENSIIE - EVRY
                        </div>
                        <button type="submit" name="login" class="btn text-dark btn-banner hvr-wobble-horizontal">Connecte toi</button>
                    </div>
                </form>
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