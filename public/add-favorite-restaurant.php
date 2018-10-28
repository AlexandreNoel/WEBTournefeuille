<?php
require '../vendor/autoload.php';

session_start();

$userRepository = new \Repository\User();
$restoRepository = new \Repository\Restaurant();

$error = [];

if (isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
    $id_restaurant = $_POST['id_resto'];

if($restoRepository->isAlreadyFavorite($id_user, $id_restaurant)){
    $restoRepository->deleteFavoriteById($id_user, $id_restaurant);
    $error = "deleted";
}else{

        if (!$restoRepository->addFavorite($id_user, $id_restaurant)) {
            $error = "cant add in favorite";
        }else{
            $error = "added";
        }

} 
}else{
    http_response_code(400);
}

echo json_encode($error);

