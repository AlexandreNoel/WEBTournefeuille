<?php
require '../vendor/autoload.php';

$userRepository = new \Repository\User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id_user'];
    $firstname = $_POST['prenom_user'];
    $lastname = $_POST['nom_user'];
    $promo = $_POST['promo_user'];
    $mail = $_POST['mail_user'];
    $password = $_POST['secret_user'];

    if ($id) {
        $user = $userRepository->findOneById($id);

        if ($user) {

            $view = [
                'user' => [
                    'prenom_user' => $firstname ?? null,
                    'nom_user' => $lastname ?? null,
                    'promo_user' => $promo ?? null,
                    'mail_user' => $mail ?? null,
                    'secret_user' => $password ?? null,
                ],
                'errors',
            ];

            $userService = new \Service\User();
            $view['errors'] = $userService->verify_registration($userRepository, $view['user']);

            if (count($view['errors']) === 0) {
                $user->setFirstname($firstname)
                    ->setLastname($lastname)
                    ->setMailAdress($mail)
                    ->setPromo($promo)
                    ->setPassword(password_hash($password, PASSWORD_BCRYPT));

                if (! $userRepository->update($user)){
                    $view['errors']['datbase'] = 'Error when updating new user';
                }

            }
        }
    }
}