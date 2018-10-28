<?php

require '../vendor/autoload.php';

$restaurantRepository = new \Repository\Restaurant();
$restaurantHydrator = new \Hydrator\Restaurant();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $name = $_POST['nom_resto'] ?? null;
    $description = $_POST['descr_resto'] ?? null;
    $address = $_POST['addr_resto'] ?? null;
    $zipCode = $_POST['cp_resto'] ?? null;
    $city = $_POST['city_resto'] ?? null;
    $phoneNumber = $_POST['tel_resto'] ?? null;
    $website = $_POST['website_resto'] ?? null;
    $thumbnail = $_POST['thumbnail'] ?? null;


    $view = [
        'restaurant' => [
            'nom_resto' => $name,
            'descr_resto' => $description,
            'addr_resto' => $address,
            'cp_resto' => $zipCode,
            'city_resto' => $city,
            'tel_resto' => $phoneNumber,
            'website_resto' => $website,
            'thumbnail' => $thumbnail

        ],
        'errors',
    ];

    $restaurantService = new \Service\Restaurant();
    $view['errors'] = $restaurantService->verify_registration($restaurantRepository, $view['restaurant']);
    if (count(array_filter($view['errors'])) === 0) {
        $newRestaurant = $restaurantHydrator->hydrate(
            [
                'nom_resto' => $name,
                'descr_resto' => $description,
                'addr_resto' => $address,
                'cp_resto' => $zipCode,
                'city_resto' => $city,
                'tel_resto' => $phoneNumber,
                'website_resto' => $website,
                'thumbnail' => $thumbnail,
            ],
            new \Entity\Restaurant()
        );
        if( ! $restaurantRepository->create($newRestaurant)){
            $view['errors']['database'] = 'Error when creating new restaurant';
        }

    }else{
        http_response_code(400);
    }

    echo json_encode($view['errors']);
}
