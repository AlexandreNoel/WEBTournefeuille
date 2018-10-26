<?php
require '../vendor/autoload.php';

session_start();



$userRepository = new \Repository\User();
$restoRepository = new \Repository\Restaurant();

if (isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
    $id_restaurant = $_POST['id_resto'];

if($restoRepository->isAlreadyFavorite($id_user, $id_restaurant)){
    $restoRepository->deleteById($id_user, $id_restaurant);
        $_SESSION['test'] = "deleted";
}else{

        if (!$restoRepository->addFavorite($id_user, $id_restaurant)) {
            $_SESSION['test'] = "cant add in favorite";
        }else{
            $_SESSION['test'] = "added";
        }
    }

} else{
    $_SESSION['test'] = "not connected";
}

header('Location: index.php');

