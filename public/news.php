<?php
/**
 * Created by PhpStorm.
 * User: Lineal
 * Date: 27/10/2018
 * Time: 04:21
 */

    require_once __DIR__.'./../vendor/autoload.php';
    session_start();

    $repositorynews = new \News\Repository\News();

    $news = $repositorynews->findAll();

    require_once '../view/news.php';