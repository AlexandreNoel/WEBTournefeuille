<?php

session_start();

?>

<!doctype html>
  <html>

    <head>

      <meta charset="utf-8">
      <meta name="viewport" content="initial-scale=1.0">
      <title>recette</title>
      <link href="http://fonts.googleapis.com/css?family=Ubuntu:400,400|Montserrat:400,700" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="css/standardize.css">
      <link rel="stylesheet" href="css/recette-grid.css">
      <link rel="stylesheet" href="css/recette.css">

    </head>

    <body class="body page-recette clearfix">

      <header class="container clearfix">

        <div class="caddie"></div>
        <h1 class="titre">Dans ton caddie !</h1>

        <div onClick="window.location='inscription.html';" class="inscription inscription-1 clearfix">
          <p class="inscription">Inscription</p>
        </div>

        <section onClick="window.location='connexion.html';" class="connexion connexion-1 clearfix">
          <p class="connexion">Connexion</p>
        </section>

        <nav class="menu clearfix">

          <div class="accueil accueil-1 clearfix">
            <p onClick="window.location='index.html';" class="accueil">Accueil</p>
          </div>

          <div onClick="window.location='recette.html';" class="hasard hasard-1 clearfix">
            <div class="hasard">
              <p>Recette au&nbsp;</p>
              <p>hasard</p>
            </div>
          </div>

          <div onClick="window.location='catalogue.html';" class="catalogue catalogue-1 clearfix">
            <p class="catalogue">Catalogue</p>
          </div>

          <div onClick="window.location='profil.html';" class="profil profil-1 clearfix">
            <p class="profil">Mon profil</p>
          </div>

        </nav>

      </header>

      <section class="recette clearfix">

        <div class="presentation clearfix">
          <div class="photo"></div>
          <h3 class="nom">Nom de la recette</h3>
          <p class="difficulte">Difficulté :</p>
          <p class="cout">Coût :</p>
        </div>

        <div class="necessaire clearfix">

          <div class="ingredients"></div>

          <div class="nom_ingredients clearfix">
            <p class="course">Liste de course :</p>
          </div>

          <div class="liste clearfix">
            <div class="text">
              <p>- Mascarpone (250g)</p>
              <p>- oeufs (4)</p>
              <p>- Sucre roux (150g)</p>
              <p>- Biscuits à la cuillère (18)</p>
              <p>- Nesquik</p>
              <p>- café noir</p>
            </div>
          </div>

        </div>

        <div class="description"></div>

      </section>

      <p class="description description-2">Description de la réalisation de la recette :</p>

      <footer class="contact clearfix">

        <div class="reseau clearfix">
          <div class="facebook"></div>
          <div class="twitter"></div>
          <div class="discord"></div>
        </div>

        <div class="adresse">
          <p>1, square de la résistance</p>
          <p>91000 Evry</p>
        </div>

      </footer>

    </body>
    
  </html>