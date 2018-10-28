<?php
require '../vendor/autoload.php';

session_start();

$restaurantRepository = new \Repository\Restaurant();

$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_resto'];

    if ($id) {
        $restaurant = $restaurantRepository->findOneById($id);
        $restaurant->setIsDeleted(true);
        $isDeleted = $restaurantRepository->delete($restaurant);

        $error = $isDeleted;
    }else{
        $error = "not deletd";
        http_response_code(400);
    }
}
echo json_encode($error);