<?php
require '../vendor/autoload.php';

if(session_status()!=PHP_SESSION_ACTIVE)
    session_start();

// Vérification si utilisateur correctement connecté
if(!isset($_SESSION['authenticated_user'])){
    header('Location: /');
}
else {

    /** @var \Client\Entity\Client $user */
    $user = $_SESSION["authenticated_user"];
    $id=$user->getId();


    $repositorytransac = new \Transaction\Repository\Transaction();

    $transactions = $repositorytransac->findByCriteria("idutilisateur", $id);


    require_once '../view/transaction.php';
}