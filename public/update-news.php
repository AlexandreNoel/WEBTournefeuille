<?php
/**
 * Created by PhpStorm.
 * User: Lineal
 * Date: 27/10/2018
 * Time: 12:27
 */

require_once __DIR__.'./../vendor/autoload.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset(
        $_POST["idannonce"],
        $_POST["titre"],
        $_POST["contenu"],
        $_POST["idauteur"],
        $_POST["datecreation"])){
        $hydrator = new News\Hydrator\News();
        $repoproducts = new News\Repository\News();
        $repoproducts->update($hydrator->hydrate($_POST, new \News\Entity\News()));
    }
} else {
    throw new \HttpInvalidParamException('Method not allowed', 405);
}
header('Location: product.php');
exit();
