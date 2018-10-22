<?php

require_once("../module/oAuth/auth/OAuthAriseClient.php");
require_once("../module/oAuth/lib/config.inc.php");

/* Temporisation de sortie */
ob_start();

/* Création de l'instance */
$consumer = OAuthAriseClient::getInstance($consumer_key, $consumer_secret, $consumer_private_key);

/* Vérification si demande de login effectué */
if (isset($_POST['login'])) {
    $consumer->authenticate();
}

/* Actualisation du token */
if ($consumer->has_just_authenticated()) {
    session_regenerate_id();
    $consumer->session_id_changed();
}

/* Vérification si l'utilisateur est identifié */
if ($consumer->is_authenticated()) {

    $results = $consumer->api()->begin()
        ->get_identifiant()
        ->get_prenom()
        ->get_nom()
        ->get_surnom()
        ->done();

    try {
        $ident = $results[0]();
        echo " Bonjour " . $ident . " !<br>";
    } catch (OAuthAPIException $e) {
        echo "Erreur : " . $e->getMessage();
    }
    try {
        $prenom = $results[1]();
        echo "Prenom " . $prenom . "<br>";
    } catch (OAuthAPIException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    try {
        $nom = $results[2]();
        echo "Nom " . $nom . "<br>";
    } catch (OAuthAPIException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    try {
        $surnom = $results[3]();
        echo "Surnom " . $surnom . "<br>";
    } catch (OAuthAPIException $e) {
        echo "Erreur : " . $e->getMessage();
    }


    if($_SESSION["superAdmin"]===true){
        header('Location: consoleHome.php');
    }
    else{
        header('Location: home.php');
    }


}









