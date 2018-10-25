<?php
/**
 * Created by PhpStorm.
 * User: Lineal
 * Date: 25/10/2018
 * Time: 23:06
 */

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset(
        $_POST["id"],
        $_POST["libelle"],
        $_POST["prix"],
        $_POST["quantitestock"],
        $_POST["reduction"],
        $_POST["idcategorie"])){
        $product = $repoproducts->findById($_POST["id"]);
        $product->setIdfamilly($_POST["idcategorie"])
            ->setPrice($_POST["prix"])
            ->setName($_POST["libelle"])
            ->setQuantity($_POST["quantitestock"])
            ->setReduction($_POST["reduction"]);
        $repoproducts->update($product);
    }
} else {
    throw new \HttpInvalidParamException('Method not allowed', 405);
}
header('Location: product.php');
exit();
