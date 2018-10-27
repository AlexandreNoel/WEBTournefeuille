<?php
namespace Service;

use  \Adapter\DatabaseFactory;
use \Service\DataCheck;

class Restaurant
{
    /**
     * @param \Repository\Restaurant $userRepository
     * @param array
     * @return array
     */
    function verify_registration($restaurantRepository, $data){
        $error = [];

        $name = $data['nom_resto'];
        $description = $data['descr_resto'];
        $address = $data['addr_resto'];
        $zipCode = $data['cp_resto'];
        $city = $data['city_resto'];
        $phoneNumber = $data['tel_resto'];
        $website = $data['website_resto'];

        $error['nom_resto'] = DataCheck::verify($name, null, null, 'nom_resto', 2, 25);
        $error['descr_resto'] = DataCheck::verify($description, null, null, 'descr_resto', 1, 200);
        $error['addr_resto'] = DataCheck::verify($address, null, null, 'addr_resto', 1, 100);
        $error['cp_resto'] = DataCheck::verify($zipCode,!is_numeric($zipCode), 'Error: cp_resto must be a number', 'cp_resto', 5, 5);
        $error['city_resto'] = DataCheck::verify($city, preg_match('#[0-9]#', $city), 'Error: city name must not contain digit', 'city_resto', 2, 50);
        $error['website_resto'] = DataCheck::verify($website, null, null, 'website_resto', 2, 50);

        $error['tel_resto'] = DataCheck::verifyNotRequired($phoneNumber, null, null, 'tel_resto', 10, 12);

        $resto = $restaurantRepository->findOneByName($name);
        if ($resto) {
            $error['nom_resto']= 'restaurant already exist';
        }
        return $error;
    }

    /**
     * @param $partnership
     * @return array
     */
    function verify_partnership($partnership){
        $error = [];

        $error ['partnership'] = DataCheck::verify($partnership, null, null, 'partnership_resto', 1, 30);

        return $error;
    }
}
