<?php
require_once __DIR__.'./../vendor/autoload.php';

// Initialisation de la session
if(session_status()!=PHP_SESSION_ACTIVE)
  session_start();

// Vérification si utilisateur correctement connecté
if(!isset($_SESSION['authenticated_user'])){
    header('Location: /');
}
else{
    /** @var \Client\Entity\Client $user */
    $user =  $_SESSION["authenticated_user"];
    $nickname = $user->getNickname();
    $firstname = $user->getFirstName();
    $lastname = $user->getLastName();
    $solde = $user->getSolde();

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
    require_once('../view/catalogue.php');
    }
 

?>