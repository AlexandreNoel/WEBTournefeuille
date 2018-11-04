<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$badges = "";
$errors = "";
$badgeRepository = new \Repository\Badge();

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    $errors = "internal error";
    http_response_code(400);
} else {
    $idResto = $_GET['id_resto'];
    if ($idResto) {
        $badges = $badgeRepository->findAllByResto($idResto);
    } else {
        http_response_code(400);
        $errors = "error";
    }
}

$vieww = ['badges' => $badges, 'errors' => $errors];
echo json_encode($vieww);
