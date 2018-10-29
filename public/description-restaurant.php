<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$restaurantRepository = new \Repository\Restaurant();
$restaurantHydrator = new \Hydrator\Restaurant();

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    $restaurant = "internal error";
    http_response_code(400);
} else {
    $id = $_GET['id_resto'];

    if ($id) {
        $restaurant = $restaurantRepository->findOneById($id);
        $restaurant = $restaurantHydrator->extract($restaurant);
    } else {
        http_response_code(400);
        $restaurant = "error";
    }
}
$view = ['data' => $restaurant, 'session' => $_SESSION];
echo json_encode($view);