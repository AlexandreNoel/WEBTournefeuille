<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$userRepository = new \Repository\User();
$restoRepository = new \Repository\Restaurant();
$userHydrator = new \Hydrator\Restaurant();

$dataRestos = [];
$errors = [];
$errorcode = '200';

if ($_SERVER['REQUEST_METHOD'] !== "GET" || ! isset($_SESSION['id'])) {
    $errors = "internal error";
    $errors = '500';
    http_response_code(500);
} else {
    $id_user = $_SESSION['id'];
    $restos = $restoRepository->findAllFavoritesByUser($id_user);

    foreach ($restos as $resto){
        $dataRestos [] = $userHydrator->extract($resto);
    }
}

$data = ['errors' => $errors, 'resto' => $dataRestos, 'errorcode' => $errorcode];
echo json_encode($data);

