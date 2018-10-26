<?php
require '../vendor/autoload.php';

session_start();



$userRepository = new \Repository\User();
$restoRepository = new \Repository\Restaurant();

$error = [];

if (isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
    $id_restaurant = $_POST['id_resto'];

if(!$restoRepository->addFavorite($id_user,$id_restaurant)){
    $error['add-favorite-restaurant'] = "cant add in favorite";
}
}else{
$error = "not connected";
}

header('Location: index.php');

