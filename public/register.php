<?php

require '../vendor/autoload.php';

session_start();

$userRepository = new \Repository\User();
$userHydrator = new \Hydrator\User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firstname = $_POST['prenom_user'] ?? null;
    $lastname = $_POST['nom_user'] ?? null;
    $isadmin =false;
    $promo = $_POST['promo_user'] ? null;
    $mail = $_POST['mail_user'] ?? null;
    $password = $_POST['secret_user'] ?? null;


    $view = [
        'user' => [
            'prenom_user' => $firstname,
            'nom_user' => $lastname ,
            'isadmin' => $isadmin,
            'promo_user' => $promo,
            'mail_user' => $mail,
            'secret_user' => $password,
        ],
        'errors',
    ];
    $userService = new \Service\User();
    $view['errors'] = $userService->verify_registration($userRepository, $view['user']);

    if (count(array_filter($view['errors'])) === 0) {

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

        if( ! $userRepository->create($newUser))
        {
            $view['errors']['database'] = 'Error when registering';
        }
        else
        {
            $_SESSION['uniqid'] = uniqid();
            $_SESSION['name'] = $firstname . " " . $lastname;
            $_SESSION['id'] = $userRepository->getIdByMail($mail);
            $_SESSION['isadmin'] = boolval($isadmin);
        }

    }else{
        http_response_code(400);
    }

    echo json_encode($view);
}
