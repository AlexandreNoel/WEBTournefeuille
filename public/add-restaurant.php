<?php

require '../vendor/autoload.php';

$restaurantRepository = new \Repository\Restaurant();
$restaurantHydrator = new \Hydrator\Restaurant();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $name = $_POST['nom_resto'];
    $description = $_POST['descr_resto'];
    $address = $_POST['addr_resto'];
    $zipCode = $_POST['cp_resto'];
    $city = $_POST['city_resto'];
    $phoneNumber = $_POST['tel_resto'];
    $website = $_POST['website_resto'];


    $view = [
        'restaurant' => [
            'nom_resto' => $name ?? null,
            'descr_resto' => $description ?? null,
            'addr_resto' => $address ?? null,
            'cp_resto' => $zipCode ?? null,
            'city_resto' => $city ?? null,
            'tel_resto' => $phoneNumber ?? null,
            'website_resto' => $website ?? null
        ],
        'errors',
    ];

    $restaurantService = new \Service\Restaurant();
    $view['errors'] = $restaurantService->verify_registration($restaurantRepository, $view['restaurant']);

    if (count($view['errors']) === 0) {
        $newRestaurant = $restaurantHydrator->hydrate(
            [
                'nom_resto' => $name,
                'descr_resto' => $description,
                'addr_resto' => $address,
                'cp_resto' => $zipCode,
                'city_resto' => $city,
                'tel_resto' => $phoneNumber,
                'website_resto' => $website
            ],
            new \Entity\Restaurant()
        );
        if( ! $restaurantRepository->create($newRestaurant)){
            $view['errors']['database'] = 'Error when creating new restaurant';
        }

        header('Location: index.php');

    } else {
        require_once('view/register.php');
    }
}