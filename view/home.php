<!DOCTYPE html>
<html>

<!-- NAVBAR !-->
<?php require_once(__DIR__ . '/partials/header.php'); ?>

<body>
    <!-- NAVBAR !-->
    <?php require_once(__DIR__ . '/partials/navbar.php'); ?>

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
                <a href="#">
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
                                        <h2 class="box-title pb-0" style="color: #bb7824;"><?php print $nickname?> </h2>
                                        <h6 class="box-title pt-0" style="color: #bb7824;"><?php print $firstname ." ". $lastname?></h6>
                                        <p class="card-block text-center">
                                            Mon compte
                                            <br>
                                            Solde: <?php print $solde ?> €
                                        </p>
                                        <a href="#" title="Mes statistiques" class="anchor btn btn-default"> <i class="fa fa-chart-bar" aria-hidden="true"></i>Mes statistiques </a>
                                        <a href="#" title="Mes transactions" class="anchor btn btn-default"> <i class="fa fa-chart-bar" aria-hidden="true"></i> Mes transactions </a>
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
