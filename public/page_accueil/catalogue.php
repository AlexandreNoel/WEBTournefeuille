<?php

session_start();

?>

<!doctype html>
  <html>
  
    <head>

      <meta charset="utf-8">
      <meta name="viewport" content="initial-scale=1.0">
      <title>catalogue</title>
      <link href="http://fonts.googleapis.com/css?family=Montserrat:400,400,700|Ubuntu:400" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="css/standardize.css">
      <link rel="stylesheet" href="css/catalogue-grid.css">
      <link rel="stylesheet" href="css/catalogue.css">

    </head>

    <body class="body page-catalogue clearfix">

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

      <section class="catalogue catalogue-3 clearfix">
        <div class="recherche"></div>
      </section>

      <p class="recherche recherche-2">Recherche :</p>

      <input class="_input" placeholder="Nom, Ingrédients, coût, difficulté..." type="text">
      <button class="_button">Rechercher</button>

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