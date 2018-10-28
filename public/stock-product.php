<?php
/**
 * Created by PhpStorm.
 * User: Lineal
 * Date: 25/10/2018
 * Time: 23:03
 */
require_once __DIR__.'./../vendor/autoload.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["quantitestock"], $_POST["idproduit"])){
        $repoproducts = new \Product\Repository\Product();
        $stock = $repoproducts->modifyStock($_POST["idproduit"], $_POST["quantitestock"]);
        echo $stock;
    }
} else {
    throw new \HttpInvalidParamException('Method not allowed', 405);
}
exit();
