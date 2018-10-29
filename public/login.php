<?php

require_once __DIR__.'./../vendor/autoload.php';
require_once ("../module/oAuth/auth/OAuthAriseClient.php");
require_once ("../module/oAuth/lib/config.inc.php");


/* Création de l'instance */
$consumer = OAuthAriseClient::getInstance($consumer_key, $consumer_secret, $consumer_private_key);
$error = false;

// Gestion de la session
if(session_status()!=PHP_SESSION_ACTIVE)
    session_start();

// Temporisation de sortie
ob_start();

/* Vérification si demande de login effectué */
if (isset($_POST['login'])) {
    $consumer->authenticate();
}

/* Vérification pour actualisation du token */
if ($consumer->has_just_authenticated()) {
    session_regenerate_id();
    $consumer->session_id_changed();
}

/* Vérification si l'utilisateur est identifié */
if ($consumer->is_authenticated()) {

    /* Déclaration des gestionnaires Client */
    $userRepository = new \Client\Repository\Client();
    $userHydrator = new \Client\Hydrator\Client();

    try {
        /* Récupération des informations cliens (AriseId) */
        $results = $consumer->api()->begin()
            ->get_identifiant()
            ->get_prenom()
            ->get_nom()
            ->get_surnom()
            ->done();

        $firstname= $results[1]();
        $lastname = $results[2]();
        $nickname = $results[3]();

        if(isset($firstname) && isset($lastname) && isset($nickname)){
            $user = $userRepository->findByAriseData($lastname,$firstname,$nickname);

            if(!isset($user)){
                $solde=0;
                $newUser = $userHydrator->hydrate(
                    [
                        'pseudo' => $nickname ?? null,
                        'nom' => $lastname ?? null,
                        'prenom' => $firstname ?? null,
                        'solde' => $solde ?? 0,
                    ],
                    new \Client\Entity\Client()
                );
                $userRepository->create($newUser);
                $_SESSION["authenticated_user"] = $newUser;
            }else {
                $_SESSION["authenticated_user"] = $user;
            }

        }
    } catch (OAuthException $e) {
        $error = true;
        $_SESSION["oAuth_error"] = $e->getMessage();
    }

    if($error){
        header('Location: /');
    }
    else if($_SESSION["superAdmin"]===true){
        header('Location: console');
    }
    else{
        header('Location: home');
    }
}









