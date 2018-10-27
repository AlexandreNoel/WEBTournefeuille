<?php
require '../vendor/autoload.php';

session_start();

$userRepository = new \Repository\User();
$restoRepository = new \Repository\Restaurant();

$error = [];

if (isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];

    $restos = $restoRepository->findAllFavoritesByUser($id_user);
    if($restos) {
        $error['add-favorite-restaurant'] = "cant find favorites";
    }
} else {
    $error = "not connected";
}

require_once('view/favorites-resto.php');

