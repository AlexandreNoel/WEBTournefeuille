<?php
    require_once __DIR__.'./../vendor/autoload.php';
    require_once ("../module/src/Client/Repository/Client.php");
    require_once ("../module/src/Client/Hydrator/Client.php");
    require_once ("../module/src/Client/Entity/Client.php");


    // Initialisation de la session
    if(session_status()!=PHP_SESSION_ACTIVE)
        session_start();

    // Vérification si utilisateur correctement connecté
    if(!isset($_SESSION['authenticated_user'])){
       header('Location: /');
    }
    else{
        /** @var \Client\Entity\Client $user */
        $user =  $_SESSION["authenticated_user"];
        $nickname = $user->getNickname();
        $firstname = $user->getFirstName();
        $lastname = $user->getLastName();
        $solde = $user->getSolde();

        require_once('../view/home.php');
    }


?>
