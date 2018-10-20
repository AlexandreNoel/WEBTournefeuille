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
    }


    /**
     * @param \Repository\User $userRepository
     * @param $mail
     * @param $password
     * @return array
     */
    function verify_connection($userRepository, $mail, $password)
    {
        $error = [];

        if ($mail && $password) {
            $user = $userRepository->findOneByMail($mail);

            if (!$user) {
                $error['user_not_exists'] = 'user does not exist';
            }
            else if ( ! password_verify($password, $user->getPassword())) {
                $error['mail-password'] = 'Mail adress and password do not match';
            }
        } else {
            if (!$mail) {
                $error['mail'] = 'Mail is required';
            }
            if (!$password) {
                $error['password'] = 'Password is required';
            }
        }

        return  $error;
    }

}

