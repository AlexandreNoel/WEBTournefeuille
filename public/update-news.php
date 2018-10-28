<?php
/**
 * Created by PhpStorm.
 * User: Lineal
 * Date: 27/10/2018
 * Time: 12:27
 */

require_once __DIR__.'./../vendor/autoload.php';
session_start();

if(!isset($_SESSION['authenticated_user'])){
    header('Location: /');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset(
        $_POST["idannonce"],
        $_POST["titre"],
        $_POST["contenu"],
        $_POST["idauteur"])){
        $hydrator = new News\Hydrator\News();
        $repoproducts = new News\Repository\News();
        $entity = $hydrator->hydrate($_POST, new \News\Entity\News());
        $repoproducts->update($entity);
    }
} else {
    throw new \HttpInvalidParamException('Method not allowed', 405);
}
header('Location: news.php');
exit();
