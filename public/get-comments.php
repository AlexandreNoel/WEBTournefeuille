<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$commentRepository = new \Repository\Comment();
$commentHydrator = new \Hydrator\Comment();
$userRepository = new \Repository\User();
$userHydrator = new \Hydrator\User();


$dataComment = null;
$errors = null;

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    $errors = "internal error";
    http_response_code(400);
} else {
    $idResto = $_GET['id_resto'];

    if ($idResto) {
        $comments = $commentRepository->findAllByResto($idResto);
        $dataComment = [];

        /** @var \Entity\Comment $comment */
        foreach ($comments as $comment) {
            $dataCom = $commentHydrator->extract($comment);

            //User
            $id_user = $comment->getIdUser();
            $user = $userRepository->getNameById($id_user);
            $dataUser = $userHydrator->extract($user);

            $data = array_merge($dataCom, $dataUser);

            $dataComment [] = $data;
        }

    } else {
        http_response_code(400);
        $errors = "error";
    }
}
$view = ['comments' => $dataComment, 'errors' => $errors];
echo json_encode($view);