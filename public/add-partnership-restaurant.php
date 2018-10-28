<?php

session_start();

require '../vendor/autoload.php';

$restoRepository = new \Repository\Restaurant();
$restaurantService = new \Service\Restaurant();

$error = ['errors'];

if (isset($_SESSION['id']) && $_SESSION['isadmin']) {
    $id_restaurant = $_POST['id_resto'];
    $partnership = $_POST['partnership'];

    $error = $restaurantService->verify_partnership($partnership);

    if(!$restoRepository->addPartnership($id_restaurant, $partnership)){
        $error['add-partnership-restaurant'] = "cant add the partnership";
    }
}else{
    $error = "not admin";
}

header('Location: index.php');

