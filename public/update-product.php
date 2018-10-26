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
            $hydrator = new Product\Hydrator\Product();
            $repoproducts->update($hydrator->hydrate($_POST, new \Product\Entity\Product()));
    }
} else {
    throw new \HttpInvalidParamException('Method not allowed', 405);
}
header('Location: product.php');
exit();
