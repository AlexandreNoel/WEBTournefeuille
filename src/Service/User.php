<?php
namespace Service;

use  \Adapter\DatabaseFactory;

class User
{
        /**
     * @param \Repository\User $userRepository
     * @param array
     * @return string
     */
       function verify_registration($userRepository, $data){
       $error = "ok";
        if(is_null($data['Prenom_User']) || $data['Prenom_User'] == ''){
        $error = 'name is required';
       }
       if(is_null($data['Nom_User']) || $data['Nom_User'] == ''){
        $error = 'lastname is required';
       }
       if(is_null($data['isAdmin'])){
        $error = 'isadmin is required, internal error';
       }
       if(is_null($data['Promo_User']) || $data['Promo_User'] == ''){
        $error = 'Promo is required';
       }
        if(is_null($data['mail_User']) || $data['mail_User'] == ''){
        $error = 'Mail is required';
        }else{
        $user = $userRepository->findOneByMail($data['mail_User']);
       if ($user) {
                $error = 'user already exist';
            }
       }
        
        if(is_null($data['Secret_User']) || $data['Secret_User'] == ''){
        $error = 'Password is required';
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
