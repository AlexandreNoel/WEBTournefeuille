<?php
    // Initialisation de la session
    if(session_status()!=PHP_SESSION_ACTIVE)
        session_start();
    ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" sizes="96x96" href="../public/assets/images/favicon.ico">
    <title>Le Bar D - ERROR 404</title>

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

    <div class="text-center">
        <a href="/"><i class="fa fa-home"></i> Page de bienvenue</a>
        <?php if(isset($_SESSION['authenticated_user'])){?>
            <br> <a href="/home"><i class="fa fa-user"></i> Accueil utilisateur</a>
        <?php } ?>
    </div>
    <!-- CONTENU !-->
    <div class="error-404">

        <h1>Aie ! Vous vous êtes trompé de chemin..</h1>
        <img src="assets/images/oops.jpg" class="img-circle" alt="Oops">

    </div>



</body>

</html>
