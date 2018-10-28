<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$userRepository = new \Repository\User();
$restoRepository = new \Repository\Restaurant();

if ($_SERVER['REQUEST_METHOD'] !== "PUT" /*|| !isset($_SESSION['id'])*/) {
    $error = "internal error";
    http_response_code(400);
} else {
    $id_user = $_SESSION['id'];
    $restoRepository->findAllFavoritesByUser($id_user);
    if($restos) {
        $error = "cant find favorites";

        http_response_code(400);
    }
}
$data = ['error' => $error, '$restos' => $restos];
echo json_encode($$data);

