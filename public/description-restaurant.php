<?php
require '../vendor/autoload.php';

session_start();

$restaurantRepository = new \Repository\Restaurant();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_resto'];

    if ($id) {
        $error = $restaurantRepository->findOneById($id);
    }else{
        http_response_code(400);
        $error = "error";
    }
}

echo json_encode($error);