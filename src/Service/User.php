<?php
namespace Service;

use  \Adapter\DatabaseFactory;

class User
{
        /**
     * @param \Repository\User $userRepository
     * @param array
     * @return array
     */
       function verify_registration($userRepository, $data){
         $error = [];
       if($data['prenom_user']){
        $error['prenom_user'] = 'name is required';
       }
       if($data['nom_user']){
        $error['nom_user'] = 'lastname is required';
       }
       if($data['isadmin']){
        $error['mail'] = 'isadmin is required, internal error';
       }
       if($data['promo']){
        $error['promo'] = 'Promo is required';
       }
        if($data['mail']){
        $error['mail'] = 'Mail is required';
        } 
        if(!$data['password']){
        $error['password'] = 'Password is required';
       }

       $user = $userRepository->findOneByMail($mail);
       if ($user) {
                $error['user_not_exists'] = 'user already exist';
            }
            return $error;
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
