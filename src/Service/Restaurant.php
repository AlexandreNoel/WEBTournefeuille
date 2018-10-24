<?php
namespace Service;

use  \Adapter\DatabaseFactory;

class Restaurant
{
        /**
     * @param \Repository\Restaurant $userRepository
     * @param array
     * @return string
     */
       function verify_registration($restaurantRepository, $data){

        if(is_null($data['nom_resto']) || $data['nom_resto'] == ''){
        return 'name is required or data type is incorrect';
       }
       if(is_null($data['descr_resto']) || $data['descr_resto'] == ''){
        return 'restaurant\'s description is required or data type is incorrect';
       }
       if(is_null($data['addr_resto']) || $data['addr_resto'] == ''){
        return 'restaurant\'s adress is required or data type is incorrect';
       }
       if(is_null($data['cp_resto']) || $data['cp_resto'] == '' || !(is_numeric($data['cp_resto']))){
        return 'restaurant\'s zip code is required or data type is incorrect';
       }
       if(is_null($data['tel_resto']) || $data['tel_resto'] == '' || !(is_numeric($data['tel_resto']))){
        return 'phone_number is required or data type is incorrect';
       }
  
        $resto = $restaurantRepository->findOneByName($data['nom_resto']);
       if ($resto) {
                return 'restaurant already exist';
            }        
            return 'ok';
       }
}
