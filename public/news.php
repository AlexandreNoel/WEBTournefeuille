<?php

require_once __DIR__.'./../vendor/autoload.php';


// Initialisation de la session
if(session_status()!=PHP_SESSION_ACTIVE)
    session_start();

// Vérification si utilisateur correctement connecté
if(!isset($_SESSION['authenticated_user'])){
    header('Location: /');
}
else {
    $newsRepository = new \News\Repository\News();
    $userRepository = new \Client\Repository\Client();

    //========================================
    // Gestion de l'utilisateur
    //========================================
    /** @var \Client\Entity\Client $user */
    $user = $_SESSION["authenticated_user"];
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
    if(isset($_GET['id'])){
        $allNews = false;
        /** @var \News\Entity\News $news */
        $news = $newsRepository->findById((int)$_GET['id']);
        if($news->getImage() != null && $news->getImage() != ""){
            $newsCover = $news->getImage();
        }
        else{
            $newsCover = "/assets/images/articles/art1.jpg";
        }
    }
    else{
        $allNews = true;
        $news = $newsRepository->findAll();
    }

    require_once('../view/news.php');
}