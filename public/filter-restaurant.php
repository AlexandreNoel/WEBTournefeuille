<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$userRepository = new \Repository\User();
$restoRepository = new \Repository\Restaurant();
$userHydrator = new \Hydrator\Restaurant();

$dataRestos = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    $errors = "internal error";
    http_response_code(400);
} else {
    $scoreResto = isset($_GET['score'])        &&  "" !== ($_GET['score'])      ? $_GET['score']    : null;
    $categorie  = isset($_GET['categorie'])    &&  "" !== ($_GET['categorie'])  ? $_GET['categorie']: null;
    $badge      = isset($_GET['badge'])        &&  "" !== ($_GET['badge'])      ? $_GET['badge']    : null;

    $id_user    = $_GET['favorite'] && $_GET['favorite']==='true' &&  $_SESSION['id'] ? $_SESSION['id']: null;

    $restos = $restoRepository->filterRestaurants($scoreResto, $badge, $categorie, $id_user);

    foreach ($restos as $resto){
        $dataRestos [] = $userHydrator->extract($resto);
    }
}


$data = ['errors' => $errors, 'resto' => $dataRestos];
echo json_encode($data);