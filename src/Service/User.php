<?php
namespace Service;

use  \Adapter\DatabaseFactory;

class User
{
    function isExisting($data){
    $adapter = new DatabaseFactory();
    $connection = $adapter->getDbAdapter();

        $repo = new \Repository\User($connection);
       if(!is_null($repo->findOneByMail($data['mail_User']))){
        return true;
       }

       return false;
    }
   function verify_registration($data){
        
       if(!isset($data['prenom_user'])){
        return "Error with firstname";
       }
       if(!isset($data['nom_user'])){
        return "Error with firstname";
       }
       if(!isset($data['isadmin'])){
        return "Error with firstname";
       }
       if(!isset($data['promo'])){
        return "Error with firstname";
       }
        if(!isset($data['mail'])){
        return "Error with firstname";
        } 
        if(!isset($data['password'])){
        return "Error with firstname";
       }
        return "ok";
    }

}

