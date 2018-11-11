<?php

    require_once __DIR__.'./../vendor/autoload.php';
    session_start();

    if(!isset($_SESSION['authenticated_admin'])){
        header('Location: /connect-console');
    }
    $repositorynews = new \News\Repository\News();
    $repositoryclients = new \Client\Repository\Client();
    $news = $repositorynews->findAll();
    $auteurlist = array();

    foreach ($news as $newsentity){
        $id_auteur = $newsentity->getIdauteur();
        if (!array_key_exists($id_auteur, $auteurlist)){
            $auteurlist[$id_auteur] = $repositoryclients->findOneById($id_auteur)->getNickname();
        }
    }

    require_once '../view/gestionNews.php';