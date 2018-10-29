<?php
    require_once __DIR__.'./../vendor/autoload.php';


    // Initialisation de la session
    if(session_status()!=PHP_SESSION_ACTIVE)
        session_start();

    // Vérification si utilisateur correctement connecté
    if(!isset($_SESSION['authenticated_user'])){
       header('Location: /');
    }
    else{
        $newsRepository = new \News\Repository\News();

        /** @var \Client\Entity\Client $user */
        $user =  $_SESSION["authenticated_user"];
        $nickname = $user->getNickname();
        $firstname = $user->getFirstName();
        $lastname = $user->getLastName();
        $solde = $user->getSolde();

        require_once('../view/home.php');
    }


?>
