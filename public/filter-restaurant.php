<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$userRepository = new \Repository\User();
$restoRepository = new \Repository\Restaurant();
$userHydrator = new \Hydrator\Restaurant();

$dataRestos = [];
$errors = [];
$errorcode = "200";

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    $errorcode = "500";
    $errors = "internal error";
    http_response_code(500);
} else {
    $categorie  =$_GET['categorie']    && ! empty($_GET['categorie'])  ? $_GET['categorie']: null;
    $badge      =$_GET['badge']        && ! empty($_GET['badge'])      ? $_GET['badge']    : null;

    $scoreResto = isset($_GET['score']) &&  '' !== ($_GET['score']) && $_GET['score'] != -1 ? $_GET['score']: null; //scoreResto value can equal 0
    $id_user    = $_GET['favorite']     &&  $_GET['favorite']==='true' &&  $_SESSION['id'] ? $_SESSION['id']: null;

    $restos = $restoRepository->filterRestaurants($scoreResto, $badge, $categorie, $id_user);

    foreach ($restos as $resto){
        $dataRestos [] = $userHydrator->extract($resto);
    }
}


$data = ['errors' => $errors, 'resto' => $dataRestos, 'errorcode' => $errorcode];
echo json_encode($data);