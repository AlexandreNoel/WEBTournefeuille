<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$restaurantRepository = new \Repository\Restaurant();
$restaurantHydrator = new \Hydrator\Restaurant();

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    $error = "internal error";
    http_response_code(400);
} else {
    $id = $_GET['id_resto'];

    if ($id) {
        $error = $restaurantRepository->findOneById($id);
        $error = $restaurantHydrator->extract($error);
    } else {
        http_response_code(400);
        $error = "error";
    }
}

echo json_encode($error);