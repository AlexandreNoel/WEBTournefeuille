<?php
require '../vendor/autoload.php';

session_start();

$restoRepository = new \Repository\Restaurant();

$_POST['ids']=[1,2,3];
$_POST['id_resto']=1;

if (!$_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = "request is not in post";
    require_once('view/users.php');
}
if (isset($_SESSION['id']) && isset($_SESSION['isadmin']) && $_SESSION['isadmin']) {
    $id_user = $_SESSION['id']; 
    $ids = $_POST['ids'];
    $idResto = $_POST[id_resto];
    $restos = $restoRepository->associateBadges($idResto,$ids);
}

require_once('view/favorites-resto.php');

