<?php
require '../vendor/autoload.php';

$userRepository = new \Repository\User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id_user'] ?? null;
    $firstname = $_POST['prenom_user'] ?? null;
    $lastname = $_POST['nom_user'] ?? null;
    $promo = $_POST['promo_user'] ?? null;
    $mail = $_POST['mail_user'] ?? null;
    $password = $_POST['secret_user'] ?? null;

    if ($id) {
        $user = $userRepository->findOneById($id);

        if ($user) {

            $view = [
                'user' => [
                    'prenom_user' => $firstname,
                    'nom_user' => $lastname ,
                    'promo_user' => $promo ,
                    'mail_user' => $mail ,
                    'secret_user' => $password ,
                ],
                'errors',
            ];

            $userService = new \Service\User();
            $view['errors'] = $userService->verify_registration($userRepository, $view['user']);

            //remove error mail_user_exist
            unset($view['errors']['mail_user_exist']);

            if (count(array_filter($view['errors'])) === 0) {
                $user->setFirstname($firstname)
                    ->setLastname($lastname)
                    ->setMailAdress($mail)
                    ->setPromo($promo)
                    ->setPassword(password_hash($password, PASSWORD_BCRYPT));

                if (! $userRepository->update($user)){
                    $view['errors']['database'] = 'Error when updating new user';
                }

            } else{
                http_response_code(400);
            }

            echo json_encode($view['errors']);
        }
    }
}