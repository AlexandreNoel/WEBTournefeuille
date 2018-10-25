<?php
require '../vendor/autoload.php';

$restaurantRepository = new \Repository\Restaurant();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id_resto'];
    $name = $_POST['nom_resto'];
    $description = $_POST['descr_resto'];
    $address = $_POST['addr_resto'];
    $zipCode = $_POST['cp_resto'];
    $city = $_POST['city_resto'];
    $phoneNumber = $_POST['tel_resto'];
    $website = $_POST['website_resto'];

    if ($id) {
        $restaurant = $restaurantRepository->findOneById($id);

        if ($restaurant) {

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
                $restaurant->setName($name)
                    ->setDescription($description)
                    ->setAddress($address)
                    ->setZipCode($zipCode)
                    ->setCity($city)
                    ->setPhoneNumber($phoneNumber)
                    ->setUrl($website);

                if (! $restaurantRepository->update($restaurant)){
                    $view['errors']['datbase'] = 'Error when updating new restaurant';
                }

            }
        }
    }
}