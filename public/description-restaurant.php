<?php
require '../vendor/autoload.php';

session_start();

$restaurantRepository = new \Repository\Restaurant();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_resto'];

    if ($id) {
        $resto = $restaurantRepository->findOneById($id);
    }else{
        $resto = "error";
    }
}

require_once('view/description-restaurant.php');