<?php
    require '../vendor/autoload.php';
    require_once ("../module/src/Client/Repository/Client.php");
    require_once ("../module/src/Client/Hydrator/Client.php");
    require_once ("../module/src/Client/Entity/Client.php");
    require_once ("../module/src/Product/Repository/Product.php");
    require_once ("../module/src/Product/Hydrator/Product.php");
    require_once ("../module/src/Product/Entity/Product.php");

    // Initialisation de la session
    if(session_status()!=PHP_SESSION_ACTIVE)
        session_start();

    // Vérification si Admin connecté
    $_SESSION['authenticated_admin']=true;
    // Vérification si Admin connecté
    if(!isset($_SESSION['authenticated_admin'])){
        header('Location: /');
    }
    else{

        //=======================================
        // Déclarations modules
        //=======================================

        /* Déclaration des gestionnaires */
        $userRepository = new \Client\Repository\Client();
        $userHydrator = new \Client\Hydrator\Client();
        $productRepository = new \Product\Repository\Product();
        $productHydrator = new \Product\Hydrator\Product();

        /** @var \Client\Entity\Client $user */
        $user =  $_SESSION["authenticated_user"];
        // Récupèration des informations utilisateurs
        $nickname = $user->getNickname();
        $firstname = $user->getFirstName();
        $lastname = $user->getLastName();
        $solde = $user->getSolde();

        //========================================
        // Traitements
        //========================================
        //Récupération des données utilisateurs
        $usersEntity = $userRepository->fetchAllUsers();
        $usersNickname = [];
        foreach ($usersEntity as $user) {
            $usersNickname[] = $user->getNickname();
        }

        //Récupération des produits disponibles
        //$products = $productRepository->findAll();
        //$productsObject = $productHydrator->extract($products);

        require_once('../view/console.php');
    }

?>