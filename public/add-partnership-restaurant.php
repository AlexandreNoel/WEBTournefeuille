<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$restoRepository = new \Repository\Restaurant();
$restaurantService = new \Service\Restaurant();

$error = "null";
if ($_SERVER['REQUEST_METHOD'] !== 'POST'  || !isset($_SESSION['id']) || !$_SESSION['isadmin']) {
    $error = "internal error";
    http_response_code(400);
}else{
    $id_restaurant = $_POST['id_resto'];
    $partnership = $_POST['partnership'];
    $error = $restaurantService->verify_partnership($partnership);

    if (!$restoRepository->addPartnership($id_restaurant, $partnership)) {
        $error = "cant add the partnership";
    } 
}
echo json_encode($error);
