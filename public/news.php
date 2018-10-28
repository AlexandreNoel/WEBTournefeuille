<?php
/**
 * Created by PhpStorm.
 * User: Lineal
 * Date: 27/10/2018
 * Time: 04:21
 */

    require_once __DIR__.'./../vendor/autoload.php';
    session_start();

    if(!isset($_SESSION['authenticated_user'])){
        header('Location: /');
    }
    $repositorynews = new \News\Repository\News();
    $repositoryclients = new \Client\Repository\Client();

    var_dump($_SESSION);
    $news = $repositorynews->findAll();
    $auteurlist = array();

    foreach ($news as $newsentity){
        $id_auteur = $newsentity->getIdauteur();
        if (!array_key_exists($id_auteur, $auteurlist)){
            $auteurlist[$id_auteur] = $repositoryclients->findOneById($id_auteur)->getNickname();
        }
    }

    require_once '../view/news.php';