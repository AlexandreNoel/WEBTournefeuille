<?php
namespace Service;

use  \Adapter\DatabaseFactory;
use \Service\DataCheck;

class User
{


    /**
     * @param \Repository\User $userRepository
     * @param array
     * @return array
     */
    function verify_registration($userRepository, $data){
        $error = [];

        $name = $data['prenom_user'];
        $lastname = $data['nom_user'];
        $promo = $data['promo_user'];
        $mail= $data['mail_user'];
        $password = $data['secret_user'];

        $error['prenom_user'] = DataCheck::verify($name,preg_match('#[0-9]#',$name),'Error: name must not contain digit','prenom_user',2,25);
        $error['nom_user'] = DataCheck::verify($lastname,preg_match('#[0-9]#',$lastname),'Error: lastname must not contain digit','nom_user',2,25);
        $error['promo_user'] = DataCheck::verify($promo,!is_numeric($promo),'Error: promotion must be a number','promo_user',4,4);
        $error['mail_user'] = DataCheck::verify($mail,!(filter_var($mail, FILTER_VALIDATE_EMAIL)),'Error: mail format error','mail_user',5,40);

        if($userRepository->findOneByMail($mail)){
            $error['mail_user_exist'] = 'user already exist';
        }

        $error['secret_user'] = DataCheck::verify($password,false,'','secret_user',4,100);

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
