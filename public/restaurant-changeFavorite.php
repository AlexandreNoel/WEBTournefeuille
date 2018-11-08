<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$restoRepository = new \Repository\Restaurant();

$result = null;

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['id'])) {
    $result = "internal error";
    http_response_code(400);

}else{
    $id_user = $_SESSION['id'];
    $id_restaurant = $_POST['id_resto'];

    if($id_restaurant) {
        if ($restoRepository->isAlreadyFavorite($id_user, $id_restaurant)) {
            $restoRepository->deleteFavoriteById($id_user, $id_restaurant);
            $result = false;
        } else {
            $restoRepository->addFavorite($id_user, $id_restaurant);
            $result = true;
        }
    } else{
        http_response_code(400);
        $errors = "error";
    }
}

$data = ['isFavorite' => $result];
echo json_encode($data);

