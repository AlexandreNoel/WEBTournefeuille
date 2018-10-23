<?php

require '../vendor/autoload.php';

$userRepository = new \Repository\User();
$userHydrator = new \Hydrator\User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firstname = $_POST['prenom_user'];
    $lastname = $_POST['nom_user'];
    $isadmin =false;
    $promo = $_POST['promo_user'];
    $mail = $_POST['mail_user'];
    $password = $_POST['secret_user'];

  
    $view = [
        'user' => [
            'prenom_user' => $firstname ?? null,
            'nom_user' => $lastname ?? null,
            'isadmin' => $isadmin ?? null,
            'promo_user' => $promo ?? null,
            'mail_user' => $mail ?? null,
            'secret_user' => $password ?? null,
        ]
    ];
    $userService = new \Service\User();
    $error = $userService->verify_registration($userRepository, $view['user']);

    if ($error == 'ok') {

        $newUser = $userHydrator->hydrate(
            [
                'prenom_user' => $firstname,
                'nom_user' => $lastname,
                'isadmin' => $isadmin,
                'promo_user' => $promo,
                'mail_user' => $mail,
                'secret_user' => password_hash($password, PASSWORD_BCRYPT)
            ],
            new \Entity\User()
        );
        $userRepository->create($newUser);

        header('Location: index.php');

    }else{
        echo $error;
        require_once('view/register.php');
    }
}
