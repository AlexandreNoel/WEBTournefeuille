<?php
    require '../vendor/autoload.php';
    require_once ("../module/src/Client/Repository/Client.php");
    require_once ("../module/src/Client/Hydrator/Client.php");
    require_once ("../module/src/Client/Entity/Client.php");

    // Initialisation de la session
    if(session_status()!=PHP_SESSION_ACTIVE)
        session_start();

    // Vérification si Admin connecté
    if(!isset($_SESSION['authenticated_admin'])){
        header('Location: /');
    }
    else{
        /* Déclaration des gestionnaires Client */
        $userRepository = new \Client\Repository\Client();
        $userHydrator = new \Client\Hydrator\Client();

        // Gestion de recherche de client
        if(isset($_POST['getUserInfo'])){
            $nickname = $_POST['getUserInfo'];
            $user = $userRepository->findOneByNickname($nickname);
            echo json_encode($userHydrator->extract($user));
        }
        return 0;
    }
