<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$restaurantRepository = new \Repository\Restaurant();

$error = "null";

if ($_SERVER['REQUEST_METHOD'] !== "DELETE" /* || $_SESSION['isadmin'] */) {
    $error = "internal error";
    http_response_code(400);
}else{
    $id = $_POST['id_resto'];

    if ($id) {
        $restaurant = $restaurantRepository->findOneById($id);
        $restaurant->setIsDeleted(true);
        $isDeleted = $restaurantRepository->delete($restaurant);

        $error = "deleted";
    }else{
        $error = "not deletd";
        http_response_code(400);
    }
}
echo json_encode($error);