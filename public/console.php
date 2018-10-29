<?php
    require_once __DIR__.'./../vendor/autoload.php';

    // Initialisation de la session
    if(session_status()!=PHP_SESSION_ACTIVE)
        session_start();

    // FORCAGE DE L'ADMIN
    $_SESSION['authenticated_admin']=true;
    // Vérification si Admin connecté
    if(!isset($_SESSION['authenticated_admin'])){
        header('Location: /');
    }
    else{

        //=======================================
        // Déclarations modules
        //=======================================
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
        /* Clients */
        $userRepository = new \Client\Repository\Client();
        $usersEntity = $userRepository->fetchAllUsers();
        $usersNickname = [];
        foreach ($usersEntity as $user) {
            $usersNickname[] = $user->getNickname();
        }

        /* Produits/Catégories */
        //Récupération des produits disponibles
        $productRepository = new \Product\Repository\Product();
        $productslist = $productRepository->findAllByCategory();
        $categories = $productRepository->getCategories();
        require_once('../view/console.php');
    }

?>