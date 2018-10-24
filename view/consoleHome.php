<?php
    require '../vendor/autoload.php';


    if(session_status()!=PHP_SESSION_ACTIVE)
        session_start();
    //postgres
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    $username = "Sphinx06";
    $userFullName = "Xavier GRIMALDI";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicon.ico">
    <title>Le Bar D - Console</title>

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

<body class="main-body">
    <!-- NAVBAR !-->
    <?php include_once('./view/navbar.php'); ?>

    <!-- CONTENU !-->

    <div class="content-container">
        <section class="tabConsole">
            <input class="tabConsoleInput" type="radio" id="search" value="1" name="tractor" checked='checked' />
            <input class="tabConsoleInput" type="radio" id="profile" value="2" name="tractor" />
            <input class="tabConsoleInput" type="radio" id="command" value="3" name="tractor" />
            <nav>
                <label for="search" class='fa fa-search'></label>
                <label for="profile" class='fa fa-user'></label>
                <label for="command" class='fa fa-store'></label>
            </nav>

            <article class='searchTab'>
                <h2>Recherche du client</h2>
                <!--Make sure the form has the autocomplete function switched off:-->

                <form class="searchAC" autocomplete="off" action="/action_page.php">
                    <div class="autocomplete" style="width:300px;">
                        <input id="myInput" type="text" name="current-user" placeholder="Client">
                    </div>
                    <input type="submit">
                </form>

            </article>

            <article class='userTab fa fa-wrench'>
                <h2>Gestion du client</h2>
                <ul class="list-group">
                    <li class="list-group-item">Nom:</li>
                    <li class="list-group-item">Prénom:</li>
                    <li class="list-group-item">Solde:</li>
                </ul>
            </article>

            <article class='commandTab fa fa-beer'>
                <h2>Gestion des commandes client</h2>
            </article>
        </section>
    </div>

    <!--Script-->
    <script src="assets/js/search.js"></script>
    <script>
        var users= ["Sphinx06","Chap","Toast","Alvis","Zerox","Erman","Rat","Trobos"];
        autocomplete(document.getElementById("myInput"), users);
    </script>
</body>

</html>
