<?php

require '../vendor/autoload.php';

session_start();

$userRepository = new \Repository\User();
$userHydrator = new \Hydrator\User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    $view = [
        'user' => [
            'mail' => $mail ?? null,
            'password' => $password ?? null,
        ],
        'errors',
    ];

    $userService = new \Service\User();
    $view['errors'] = $userService->verify_connection($userRepository, $mail, $password);

    if (count($view['errors']) === 0) {

        $user = $userRepository->findOneByMail($mail);
        $_SESSION['uniqid'] = uniqid();
        $_SESSION['name'] = $user->getFirstname()." ".$user->getLastname();
        $_SESSION['id'] = $user->isId();

        header('Location: index.php');
    }else{
        require_once('view/connect.php');
    }
}

