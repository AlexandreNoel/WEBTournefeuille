<?php
namespace Service;

class User
{
   function verify_registration($firstname,$lastname,$birthday,$mail){
       $dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new \PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


       if(!isset($firstname)){
        return "Error with firstname";
       }
       if(!isset($lastname)){
        return "Error with firstname";
       }
       if(!isset($birthday)){
        return "Error with firstname";
       }
       if(!isset($mail)){
        return "Error with firstname";
       }

       $repo = new \Repository\User($connection);
       if(!is_null($repo->findOneByMail($_POST['mail']))){
        return "Already registred";
       }
        return "ok";
    }

}

