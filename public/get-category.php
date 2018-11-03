<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$category = "";
$errors = "";
$categoryRepository = new \Repository\Categorie();

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    $errors = "internal error";
    http_response_code(400);
} else {
    $idResto = $_GET['id_resto'];
    if ($idResto) {
        $category = $categoryRepository->findOneByResto($idResto);
    } else {
        http_response_code(400);
        $errors = "error";
    }
}

$vieww = ['category' => $category, 'errors' => $errors];
echo json_encode($vieww);
