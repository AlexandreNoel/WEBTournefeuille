<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

SessionChecker::redirectIfNotAdmin();

$restoRepository = new \Repository\Restaurant();
$errorcode = "200";

$_POST['ids']=[1,2,3];
$_POST['id_resto']=1;

if (!$_SERVER['REQUEST_METHOD'] === 'POST') {
    $errorcode = "500";
    $error = "request is not in post";
    http_response_code(500);
}else{

if (isset($_SESSION['id']) && isset($_SESSION['isadmin']) && $_SESSION['isadmin']) {
    $id_user = $_SESSION['id'] || $_POST['id'];
    $ids = $_POST['ids'];
    $idResto = $_POST['id_resto'];
    $error = $restoRepository->associateBadges($idResto,$ids);
}else{
    http_response_code(400);
}
}
$error['errorcode'] = "200";
echo json_encode($error);