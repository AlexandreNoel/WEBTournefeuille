<?php
namespace Service;

use  \Adapter\DatabaseFactory;

class User
{
    function verify($data,$condition,$errorMsg,$dataname,$length_min,$length_max){
        if(isset($data) && !is_null($data) && $data != ''){
            if ($condition){
                return $errorMsg;
            }
        }else{
           return "Error: ". $dataname ." is required";
        }
        if(strlen($data) > $length_max){
            return "Error: ". $dataname ." is too long (".$length_max." max)";
        }
        if(strlen($data) < $length_min){
            return "Error: ". $dataname ." is too short (".$length_min." min)";
        }
    }


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

        $error['prenom_user'] = $this->verify($name,preg_match('#[0-9]#',$name),'Error: name must not contain digit','prenom_user',2,25);
        $error['nom_user'] = $this->verify($lastname,preg_match('#[0-9]#',$lastname),'Error: lastname must not contain digit','nom_user',2,25);
        $error['promo_user'] = $this->verify($promo,!is_numeric($promo),'Error: promotion must be a number','promo_user',4,4);
        $error['mail_user'] = $this->verify($mail,!(filter_var($mail, FILTER_VALIDATE_EMAIL)),'Error: mail format error','mail_user',5,40);

        if($userRepository->findOneByMail($mail)){
            $error['mail_user'] = 'user already exist';
        }

        $error['secret_user'] = $this->verify($password,false,'','secret_user',4,100);
        
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
