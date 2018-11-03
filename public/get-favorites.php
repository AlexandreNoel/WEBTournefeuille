<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$restoRepository = new \Repository\Restaurant();

$isFavorite = null;
$errors = null;

if ($_SERVER['REQUEST_METHOD'] !== 'GET' || ! isset($_SESSION['id'])) {
    $errors = "internal error";
    http_response_code(400);
} else {
    $idResto = $_GET['id_resto'];

    if ($idResto) {
        $isFavorite = $restoRepository->isAlreadyFavorite($_SESSION['id'], $idResto) ? true : false;

    } else {
        http_response_code(400);
        $errors = "error";
    }
}

$data = ['isFavorite' => $isFavorite, 'errors' => $errors];
echo json_encode($data);