<?php
    require_once __DIR__.'./../vendor/autoload.php';

    // Initialisation de la session
    if(session_status()!=PHP_SESSION_ACTIVE)
        session_start();

    // Vérification si Admin connecté
    if(!isset($_SESSION['authenticated_admin'])){
        header('Location: /connect-console.php');
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

        // PAS D'UTILISATEUR CONNECTÉ MAIS UNE DEMANDE DU PASSWORD BARMAN À L'ACTION
        // /** @var \Client\Entity\Client $user */
        // $user =  $_SESSION["authenticated_user"];
        // // Récupèration des informations utilisateurs
        // $nickname = $user->getNickname();
        // $firstname = $user->getFirstName();
        // $lastname = $user->getLastName();
        // $solde = $user->getSolde();

        //========================================
        // Traitements
        //========================================
        /* Clients */
        $usersEntity = $userRepository->fetchAllUsers();
        $usersNickname = [];
        foreach ($usersEntity as $user) {
            $usersNickname[] = $user->getNickname();
        }

        /* Produits/Catégories */
        //Récupération des produits disponibles
        $productslist = $productRepository->findAllByCategory();
        $categories = $productRepository->getCategories();
        require_once('../view/console.php');
    }

?>