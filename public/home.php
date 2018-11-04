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
        $userRepository = new \Client\Repository\Client();

        //========================================
        // Gestion de l'utilisateur
        //========================================
        /** @var \Client\Entity\Client $user */
        $user =  $_SESSION["authenticated_user"];
        // Mise à jour de l'utilisateur
        $user = $userRepository->findOneByNickname($user->getNickname());
        $_SESSION["authenticated_user"] = $user;
        // Initialisation des variables
        $nickname = $user->getNickname();
        $firstname = $user->getFirstName();
        $lastname = $user->getLastName();
        $solde = $user->getSolde();

        //========================================
        // Gestion des news
        //========================================
        /** @var \News\Entity\News[] $news */
        $news = $newsRepository->findLast(3);

        require_once('../view/home.php');
    }


?>
