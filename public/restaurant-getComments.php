<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");

$commentRepository = new \Repository\Comment();
$commentHydrator = new \Hydrator\Comment();
$userRepository = new \Repository\User();
$userHydrator = new \Hydrator\User();


$dataComment = null;
$errors = null;
$errorcode = "200";

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    $errors = "internal error";
    $errorcode = "500";
    http_response_code(500);
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
        $errorcode = "500";
        http_response_code(500);
        $errors = "error";
    }
}
$view = ['comments' => $dataComment, 'errors' => $errors, 'errorcode' => $errorcode];
echo json_encode($view);