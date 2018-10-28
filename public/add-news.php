<?php
/**
 * Created by PhpStorm.
 * User: Lineal
 * Date: 25/10/2018
 * Time: 23:06
 */

require_once __DIR__.'./../vendor/autoload.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset(
        $_POST["titre"],
        $_POST["contenu"],
        $_POST["idauteur"])){
        $hydrator = new News\Hydrator\News();
        $repoproducts = new News\Repository\News();
        $repoproducts->create($hydrator->hydrate($_POST, new \News\Entity\News()));
    }
} else {
    throw new \HttpInvalidParamException('Method not allowed', 405);
}
header('Location: news.php');
exit();
