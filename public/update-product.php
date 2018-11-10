<?php
require_once __DIR__.'./../vendor/autoload.php';

// Initialisation de la session
if(session_status()!=PHP_SESSION_ACTIVE)
    session_start();

    // Vérification si Admin connecté
    if(!isset($_SESSION['authenticated_admin'])){
        header('Location: /');
    }
    else{
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
                if(isset($_POST["shortcutCheck"],$_POST['shortcut'])){
                    $repoproducts->updateProductShortcut($_POST["idproduit"],$_POST['shortcut']);
                }
                else{
                    $repoproducts->deleteProductShortcut($_POST["idproduit"]);
                }
            }
        } else {
            throw new \HttpInvalidParamException('Method not allowed', 405);
        }
        header('Location: gestionProduct');
    }
exit();
