<?php

require '../vendor/autoload.php';

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \Repository\User($connection);
$userHydrator = new \Hydrator\User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firstname = $_POST['Prenom_User'];
    $lastname = $_POST['Nom_User'];
    $isadmin =false;
    $promo = $_POST['Promo_User'];
    $mail = $_POST['mail_User'];
    $password = $_POST['Secret_User'];

  
    $view = [
        'user' => [
            'Prenom_User' => $firstname ?? null,
            'Nom_User' => $lastname ?? null,
            'isAdmin' => $isadmin ?? null,
            'Promo_User' => $promo ?? null,
            'mail_User' => $mail ?? null,
            'Secret_User' => $password ?? null,
        ]
    ];
    $userService = new \Service\User();
    $error = $userService->verify_registration($userRepository, $view['user']);

    if ($error == 'ok') {
        $newUser = $userHydrator->hydrate($view['user'],new \Entity\User());
        var_dump($newUser);
    }else {
    echo $error;
    }
    echo "  --- now just add the object 'user' in the database ! :)";
}
