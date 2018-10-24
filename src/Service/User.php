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

        if(is_null($data['prenom_user']) || $data['prenom_user'] == ''){
        return 'name is required or data type is incorrect';
       }
       if(is_null($data['nom_user']) || $data['nom_user'] == ''){
        return 'lastname is required or data type is incorrect';
       }
       if(is_null($data['isadmin']) ){
        return 'isadmin is required, internal error or data type is incorrect';
       }
       if(is_null($data['promo_user']) || $data['promo_user'] == '' || !(is_numeric($data['promo_user']))){
        return 'Promo is required or data type is incorrect';
       }
        if(is_null($data['mail_user']) || $data['mail_user'] == '' || !(filter_var($data['mail_user'], FILTER_VALIDATE_EMAIL))){
        return 'Mail is required or data type is incorrect';
        }else{
        $user = $userRepository->findOneByMail($data['mail_user']);
       if ($user) {
                return 'user already exist';
            }
       }
        
        if(is_null($data['secret_user']) || $data['secret_user'] == ''){
        return 'Password is required';
       }
            return 'ok';
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
