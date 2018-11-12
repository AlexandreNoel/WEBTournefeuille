<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$category = "";
$errors = "";
$errorcode = "200";
$categoryRepository = new \Repository\Categorie();

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    $errorcode = "500";
    $errors = "internal error";
    http_response_code(500);
} else {
    $idResto = $_GET['id_resto'];
    if ($idResto) {
        $category = $categoryRepository->findOneByResto($idResto);
    } else {
        $errorcode = "500";
        http_response_code(500);
        $errors = "error";
    }
}

$vieww = ['category' => $category, 'errors' => $errors, 'errorcode' => $errorcode];
echo json_encode($vieww);
