<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

SessionChecker::redirectIfNotAdmin();

$userRepository = new \Repository\User();


if ($_SERVER['REQUEST_METHOD'] === 'PUT' && (isset($_SESSION['isadmin']))) {

    parse_str(file_get_contents("php://input"),$post_vars);

    $id = $post_vars['id_user'] ?? null;
    $firstname = $post_vars['prenom_user'] ?? null;
    $lastname = $post_vars['nom_user'] ?? null;
    $promo = $post_vars['promo_user'] ?? null;
    $mail = $post_vars['mail_user'] ?? null;
    $oldPassword = $post_vars['secret_user_old'] ?? null;
    $password = $post_vars['secret_user_new'] ?? null;
    $confirm_password = $post_vars['secret_user_new2'] ?? null;

    $view = [
        'user' => [
            'id_user' => $id,
            'prenom_user' => $firstname,
            'nom_user' => $lastname ,
            'promo_user' => $promo ,
            'mail_user' => $mail ,
            'old_password' => $oldPassword ,
            'secret_user' => $password ,
            'confirm_secret_user' => $confirm_password ,
        ],
        'errors',
    ];

    $userService = new \Service\User();
    $view['errors'] = $userService->verify_update($userRepository, $view['user']);

    if (count(array_filter($view['errors'])) === 0) {

        $user = $userRepository->findOneById($id);

        $user->setFirstname($firstname)
            ->setLastname($lastname)
            ->setMailAdress($mail)
            ->setPromo($promo)
            ->setPassword(password_hash($password, PASSWORD_BCRYPT));

        if (! $userRepository->update($user)){
            $view['errors']['database'] = 'Error when updating new user';
            http_response_code(400);
        }

    } else{
        http_response_code(400);
    }

    echo json_encode($view['errors']);
}