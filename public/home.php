<?php
    require '../vendor/autoload.php';
    require_once ("../module/src/Client/Repository/Client.php");
    require_once ("../module/src/Client/Hydrator/Client.php");
    require_once ("../module/src/Client/Entity/Client.php");
    if(session_status()!=PHP_SESSION_ACTIVE)
        session_start();


    // GESTION DES ACTUALITES A FAIRE (TOP 3)
    if(isset($_SESSION['authenticated_user'])){
        /** @var \Client\Entity\Client $user */
        $user =  $_SESSION["authenticated_user"];
        $nickname = $user->getNickname();
        $firstname = $user->getFirstName();
        $lastname = $user->getLastName();
        $solde = $user->getSolde();
    }

    require_once('../view/home.php');
?>