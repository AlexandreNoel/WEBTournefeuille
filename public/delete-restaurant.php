<?php
require '../vendor/autoload.php';

session_start();

$restaurantRepository = new \Repository\Restaurant();

$action = [
    'success' => false,
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_resto'];

    if ($id) {
        $restaurant = $restaurantRepository->findOneById($id);
        $restaurant->setIsDeleted(true);
        $isDeleted = $restaurantRepository->delete($restaurant);

        $data['success'] = $isDeleted;
    }
}

header('Location: index.php');