<!DOCTYPE html>
<html>

<head>
    <!-- HEADER !-->
    <?php require_once(__DIR__ . '/partials/header.php'); ?>
</head>
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
                            <?php for($i=0;$i<count($news);$i++): ?>
                                <?php if($i==0): ?>
                                    <li data-target="#newsCarousel" data-slide-to="<?php echo $i ?>" class="active"></li>
                                <?php else: ?>
                                    <li data-target="#newsCarousel" data-slide-to="<?php echo $i ?>" class=""></li>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <?php $i =0; foreach ($news as $aNews):?>
                                <?php if($aNews->getImage() != null && $aNews->getImage()!= ""){$coverNews = $aNews->getImage();}
                                    else{$coverNews = "assets/images/articles/art1.jpg";}
                                ?>
                                <?php if($i==0): ?>
                                    <div class="carousel-item active">
                                <?php else: ?>
                                    <div class="carousel-item">
                                <?php endif; ?>
                                        <a href="/news?id=<?php echo $aNews->getId();?>">
                                            <img class="d-block mx-auto img-fluid" style="height:200px;" src="<?php echo $coverNews; ?>" alt="">
                                            <div class="carousel-caption">
                                                <p>News:</p>
                                                <h3><?php echo $aNews->getTitle();?></h3>
                                            </div>
                                        </a>
                                    </div>
                            <?php $i++; endforeach; ?>
                        </div>

                    </div>
                </div>
            </div>

            <div class="Catalogue grid-block">
                <a href="catalogue">
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
                            <?php if($user->getImage() != null && $user->getImage() != ""): ?>
                                <div class="card-icon"><a href="#" title="Widgets" id="widgetCardIcon" style="background-image: url('<?php echo $user->getImage();?>');" class="imagecard"><span class="fa fa-user"></span></a>
                            <?php else:?>
                                <div class="card-icon"><a href="#" title="Widgets" id="widgetCardIcon" style="background-image: url('assets/images/beer_fond_small.jpg');" class="imagecard"><span class="fa fa-user"></span></a>
                            <?php endif; ?>
                                    <div class="card-data widgetCardData">
                                        <h2 class="box-title pb-0" style="color: #bb7824;"><?php print $nickname?> </h2>
                                        <h6 class="box-title pt-0" style="color: #bb7824;"><?php print $firstname ." ". $lastname?></h6>
                                        <p class="card-block text-center">
                                            Mon compte
                                            <br>
                                            Solde: <?php print $solde ?> €
                                        </p>
                                        <a href="statistiques" title="Mes statistiques" class="anchor btn btn-default"> <i class="fa fa-chart-bar" aria-hidden="true"></i>Mes statistiques </a>
                                        <a href="transaction" title="Mes transactions" class="anchor btn btn-default"> <i class="fa fa-chart-bar" aria-hidden="true"></i> Mes transactions </a>
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
