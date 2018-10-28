<?php
require '../vendor/autoload.php';

session_start();

$userRepository = new \Repository\User();
$restoRepository = new \Repository\Restaurant();

$error = [];
$restos = null;

if (isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];

    $restoRepository->findAllFavoritesByUser($id_user);
    if($restos) {
        $error['add-favorite-restaurant'] = "cant find favorites";

        http_response_code(400);
    }
}

echo json_encode($restos);

