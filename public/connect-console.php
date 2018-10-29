<?php

// Initialisation de la session
if(session_status()!=PHP_SESSION_ACTIVE)
    session_start();

unset($_SESSION['authenticated_admin']);
$required_login = "chap";
$required_password = "chap";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $view = [
        'user' => [
            'login' => $login ?? null,
            'password' => $password ?? null,
        ],
        'errors' => [],
    ];

    if ($login && $password) {
        // $user = $userRepository->findOneBylogin($login);
        // if (!$user || !password_verify(
        //         $password,
        //         $user->getPassword()
        // )) {
        //     $view['errors']['login-password'] = 'Password and login do not match';
        // }
        
        if (!strcmp($login,$required_login) && !strcmp($password,$required_password)) {
            $view['user'] = [
                'login' => $login,
                'password' => $password,
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
        $_SESSION['authenticated_admin']=true;
        header('Location: /console.php');
    }
}

require_once('../view/connect-console.php');