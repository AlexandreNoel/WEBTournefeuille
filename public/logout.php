<?php

require_once("../module/oAuth/auth/OAuthAriseClient.php");
require_once("../module/oAuth/lib/config.inc.php");

$consumer = OAuthAriseClient::getInstance($consumer_key, $consumer_secret, $consumer_private_key);


// Déconnexion totale
if (isset($_GET['logoutAriseId'])) {
    header('Location: '.$consumer->get_single_logout_uri("http://".$_SERVER['HTTP_HOST']."/index.php"));
}
// Déconnexion session
else{
    $consumer->logout();
    header('Location: index.php');
}
