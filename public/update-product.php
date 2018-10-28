<?php
/**
 * Created by PhpStorm.
 * User: Lineal
 * Date: 25/10/2018
 * Time: 23:06
 */

require_once __DIR__.'./../vendor/autoload.php';
session_start();

if(!isset($_SESSION['authenticated_user'])){
    header('Location: /');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset(
        $_POST["idproduit"],
        $_POST["libelle"],
        $_POST["prix"],
        $_POST["quantitestock"],
        $_POST["reduction"],
        $_POST["idcategorie"])){
            $hydrator = new Product\Hydrator\Product();
            $repoproducts = new Product\Repository\Product();
            $repoproducts->update($hydrator->hydrate($_POST, new \Product\Entity\Product()));
    }
} else {
    throw new \HttpInvalidParamException('Method not allowed', 405);
}
header('Location: product.php');
exit();
