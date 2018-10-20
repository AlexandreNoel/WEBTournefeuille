<?php
namespace Service;

class User
{
    function verify_registration($firstname,$lastname,$birthday,$mail)
    {
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

