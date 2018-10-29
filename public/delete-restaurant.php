<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$restaurantRepository = new \Repository\Restaurant();

$error = "null";

if ($_SERVER['REQUEST_METHOD'] !== "DELETE") {

    $error = "internal error";
    http_response_code(400);
}else{
    parse_str(file_get_contents("php://input"), $post_vars);
    $id = $post_vars['id_resto'] ?? null;


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