<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$userRepository = new \Repository\User();
$restoRepository = new \Repository\Restaurant();
$userHydrator = new \Hydrator\Restaurant();

$dataRestos = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] !== "GET" || ! isset($_SESSION['id'])) {
    $errors = "internal error";
    http_response_code(400);
} else {
    $id_user = $_SESSION['id'];
    $restos = $restoRepository->findAllFavoritesByUser($id_user);

    foreach ($restos as $resto){
        $dataRestos [] = $userHydrator->extract($resto);
    }
}

$data = ['errors' => $errors, 'resto' => $dataRestos];
echo json_encode($data);

