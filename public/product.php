<?php

    require_once __DIR__.'./../vendor/autoload.php';

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


    $productslist = [];
    $categories = $repoproducts->getCategories();
    foreach ($categories as $category) {
        $productslist[$category["libelle"]] = $repoproducts->findByCategory($category["idcategorie"]);
    }
    require_once '../view/product.php';


