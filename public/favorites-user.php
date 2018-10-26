<?php
require '../vendor/autoload.php';

session_start();

$userRepository = new \Repository\User();
$restoRepository = new \Repository\Restaurant();

$error = [];

if (isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];

    $restos = $restoRepository->findAllByUser($id_user);
    if($restos) {
        $error['add-favorite-restaurant'] = "cant find favorites";
    }
} else {
    $error = "not connected";
}

var_dump($restos);

require_once('view/favorites-resto.php');

