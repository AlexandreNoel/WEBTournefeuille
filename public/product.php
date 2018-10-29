<?php

    require_once __DIR__.'./../vendor/autoload.php';

    session_start();
    if(!isset($_SESSION['authenticated_user'])){
        header('Location: /');
    }

    $repoproducts = new \Product\Repository\Product();

    if (isset(
        $_POST["id"],
        $_POST["libelle"],
        $_POST["prix"],
        $_POST["quantitestock"],
        $_POST["reduction"],
        $_POST["idcategorie"])){
            $product = $repoproducts->findById($_POST["id"]);
            $repoproducts->update($product);
    }


    $productslist = $repoproducts->findAllByCategory();
    $categories = $repoproducts->getCategories();
    require_once '../view/product.php';


