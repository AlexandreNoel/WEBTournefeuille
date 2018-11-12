<?php
require_once __DIR__.'./../vendor/autoload.php';

use \Adapter\DatabaseFactory;

// Initialisation de la session
if(session_status()!=PHP_SESSION_ACTIVE)
    session_start();

unset($_SESSION['authenticated_admin']);


$PREFIX_SAL = "[BARD]";

$view = [
    'user' => [
        'login' => $login ?? null,
        'password' => $password ?? null,
    ],
    'errors' => [],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if ($login && $password) {

        $passwordHashed= hash('sha256',$PREFIX_SAL.$password);
        $dbFactory = new DatabaseFactory();
        $dbAdapter = $dbFactory->getDbAdapter();

        $statement=$dbAdapter->prepare('SELECT * FROM admin WHERE login ILIKE :login and password ILIKE :password');
        $statement->bindParam(':login', $login);
        $statement->bindParam(':password', $passwordHashed);
        $statement->execute();

        if($statement->rowCount() > 0){
            $result =$statement->fetchAll();
            $view['user'] = [
                'login' => $result[0]['login']
            ];
        } else {
                $view['errors']['login-password'] = 'Password and login do not match';
        }


    } else {
        if (!$login) {
            $view['errors']['login'] = 'login is required';
        }
        if (!$password) {
            $view['errors']['password'] = 'Password is required';
        }
    }

    if (count($view['errors']) === 0) {
        $_SESSION['authenticated_admin']=$view['user'];
        header('Location: /console');
    }
}

require_once('../view/connect-console.php');
