<?php

require '../vendor/autoload.php';


$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \Repository\User($connection);
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
        $_SESSION['uniqid'] = uniqid();
        $_SESSION['mail'] = $mail;

        header('Location: index.php');
    }
}
require_once('../view/connect.php');

