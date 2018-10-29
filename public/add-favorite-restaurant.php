<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$restoRepository = new \Repository\Restaurant();

$result = "null";
if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !isset($_SESSION['id'])) {
    $result = "internal error";
    http_response_code(400);
}else{
    $id_user = $_SESSION['id'];
    $id_restaurant = $_POST['id_resto'];
    $is_favorite = $_POST['id_resto'];

    if ($restoRepository->isAlreadyFavorite($id_user, $id_restaurant) && $is_favorite) {
        $restoRepository->deleteFavoriteById($id_user, $id_restaurant);
        $result = "deleted";
    } else {
        $restoRepository->addFavorite($id_user, $id_restaurant);
        $result = "added";
    }

}

echo json_encode($result);

