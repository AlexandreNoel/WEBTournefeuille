<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$badges = "";
$errors = "";
$errorcode = "200";
$badgeRepository = new \Repository\Badge();

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    $errorcode = "500";
    $errors = "internal error";
    http_response_code(500);
} else {
    $idResto = $_GET['id_resto'];
    if ($idResto) {
        $badges = $badgeRepository->findAllByResto($idResto);
    } else {
        $errorcode = "500";
        $errors = "error";
        http_response_code(500);
    }
}

$vieww = ['badges' => $badges, 'errors' => $errors, 'errorcode' => $errorcode];
echo json_encode($vieww);
