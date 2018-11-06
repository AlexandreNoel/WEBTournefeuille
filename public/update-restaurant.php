<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");

use Service\SessionChecker;
SessionChecker::redirectIfNotAdmin();

$restaurantRepository = new \Repository\Restaurant();
$catRepository = new \Repository\Categorie();
$badgeRepository = new \Repository\Badge();

if ($_SERVER['REQUEST_METHOD'] === 'PUT' && (isset($_SESSION['isadmin']))) {

    parse_str(file_get_contents("php://input"),$post_vars);

    $id = $post_vars['id_resto'] ?? null;
    $name = $post_vars['nom_resto'] ?? null;
    $description = $post_vars['descr_resto'] ?? null;
    $address = $post_vars['addr_resto'] ?? null;
    $zipCode = $post_vars['cp_resto'] ?? null;
    $city = $post_vars['city_resto'] ?? null;
    $phoneNumber = $post_vars['tel_resto'] ?? null;
    $website = $post_vars['website_resto'] ?? null;
    $thumbnail = $post_vars['thumbnail'] ?? null;
    $categorie = $post_vars['categorie'] ?? null;
    $badges = $post_vars['badges'] ?? null;

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
                    'website_resto' => $website,
                    'thumbnail' => $thumbnail,
                    'categorie' => $categorie,
                    'badges'=>$badges
                ],
                'errors',
            ];
            $restaurantService = new \Service\Restaurant();
            $view['errors'] = $restaurantService->verify_registration($restaurantRepository, $view['restaurant']);

            //remove error mail_user_exist
            unset($view['errors']['nom_resto_exist']);

            if (count(array_filter($view['errors'])) === 0) {
                $restaurant->setName($name)
                    ->setDescription($description)
                    ->setAddress($address)
                    ->setZipCode($zipCode)
                    ->setCity($city)
                    ->setPhoneNumber($phoneNumber)
                    ->setUrl($website)
                    ->setThumbnail($thumbnail);

                if (! $restaurantRepository->update($restaurant)){
                    $view['errors']['database'] = 'Error when updating new restaurant';
                    http_response_code(400);
                }

                $cat = $catRepository->findOneByName($categorie);
                $idCat  = $cat->getId();

                if (!$catRepository->associateCategorie($id,$idCat)){
                    $view['errors']['database'] = 'Error when associating a categorie';
                }
                if (!$badgeRepository->associateBadges($id, $badges)){
                    $view['errors']['database'] = 'Error when associating badges';
                }

            }
            else{
                http_response_code(400);
            }

            echo json_encode($view);
        }
    }
}