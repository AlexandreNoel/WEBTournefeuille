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
    $nickname = $user->getNickname();

    $repositorytransac = new \Transaction\Repository\Transaction();
    $repositorytclient = new \Client\Repository\Client();
    $allusers=$repositorytclient->fetchAllUsers();
    $nicknameforid=[];
    #association de tous les userId à leur nickname
    foreach ($allusers as $user){
        $nicknameforid[$user->getId()]=$user->getNickname();
    }
    $transactions = $repositorytransac->findByCriteria("idutilisateur", $id);
    $expensesweek = $repositorytransac->getExpenseslastDays($id,7);
    $expensesmonth = $repositorytransac->getExpenseslastDays($id,31);
    $solde=$user->getSolde();

    require_once '../view/statistiques.php';
}