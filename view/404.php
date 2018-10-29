<?php
    // Initialisation de la session
    if(session_status()!=PHP_SESSION_ACTIVE)
        session_start();
    ?>
<!DOCTYPE html>
<html>

<!-- NAVBAR !-->
<?php require_once(__DIR__ . '/partials/header.php'); ?>

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
