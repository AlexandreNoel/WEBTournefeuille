<?php
/**
 * Created by PhpStorm.
 * User: Lineal
 * Date: 25/10/2018
 * Time: 23:04
 */

    require_once __DIR__.'./../vendor/autoload.php';

    session_start();

    if(!isset($_SESSION['authenticated_user'])){
        header('Location: /');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["id_product"])){
            $repoproducts = new \Product\Repository\Product();
            $repoproducts->delete($_POST["id_product"]);
        }
    } else {
        throw new \HttpInvalidParamException('Method not allowed', 405);
    }
    header('Location: product.php');
    exit();
