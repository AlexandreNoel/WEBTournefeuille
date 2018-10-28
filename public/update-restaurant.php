<?php
require '../vendor/autoload.php';

$restaurantRepository = new \Repository\Restaurant();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id_resto'] ?? null;
    $name = $_POST['nom_resto'] ?? null;
    $description = $_POST['descr_resto'] ?? null;
    $address = $_POST['addr_resto'] ?? null;
    $zipCode = $_POST['cp_resto'] ?? null;
    $city = $_POST['city_resto'] ?? null;
    $phoneNumber = $_POST['tel_resto'] ?? null;
    $website = $_POST['website_resto'] ?? null;

    if ($id) {
        $restaurant = $restaurantRepository->findOneById($id);

        if ($restaurant) {

            $view = [
                'restaurant' => [
                    'nom_resto' => $name,
                    'descr_resto' => $description,
                    'addr_resto' => $address,
                    'cp_resto' => $zipCode,
                    'city_resto' => $city,
                    'tel_resto' => $phoneNumber,
                    'website_resto' => $website
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
                    $view['errors']['database'] = 'Error when updating new restaurant';
                }

            }
            else{
                http_response_code(400);
            }

            echo json_encode($view);
        }
    }
}