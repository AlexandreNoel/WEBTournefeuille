<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$userRepository = new \Repository\User();
$userHydrator = new \Hydrator\User();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $error = "internal error";
    http_response_code(400);
} else {
    $mail = $_POST['mail_user'] ?? null;
    $password = $_POST['secret_user'] ?? null;

    $view = [
        'user' => [
            'mail' => $mail,
            'secret_user' => $password,
        ],
        'errors',
    ];

    $userService = new \Service\User();
    $view['errors'] = $userService->verify_connection($userRepository, $mail, $password);

    if (count($view['errors']) === 0) {

        $user = $userRepository->findOneByMail($mail);
        $_SESSION['uniqid'] = uniqid();
        $_SESSION['name'] = $user->getFirstname() . " " . $user->getLastname();
        $_SESSION['id'] = $user->getId();
        $_SESSION['isadmin'] = boolval($user->isAdmin());
    } else {
        http_response_code(400);
    }
}
$view['session'] = $_SESSION;
    echo json_encode($view);


