<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$restoRepository = new \Repository\Restaurant();

$isFavorite = null;
$errors = null;
$errorcode = "200";

if ($_SERVER['REQUEST_METHOD'] !== 'GET' || ! isset($_SESSION['id'])) {
    $errors = "internal error";
    $errorcode = "500";
    http_response_code(500);
} else {
    $idResto = $_GET['id_resto'];

    if ($idResto) {
        $isFavorite = $restoRepository->isAlreadyFavorite($_SESSION['id'], $idResto) ? true : false;

    } else {
        $errorcode = "500";
        http_response_code(500);
        $errors = "error";
    }
}

$data = ['isFavorite' => $isFavorite, 'errors' => $errors, 'errorcode' => $errorcode];
echo json_encode($data);