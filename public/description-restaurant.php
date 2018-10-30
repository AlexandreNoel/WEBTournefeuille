<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$restaurantRepository = new \Repository\Restaurant();
$restaurantHydrator = new \Hydrator\Restaurant();
$commentRepository = new \Repository\Comment();
$commentHydrator = new \Hydrator\Comment();
$userRepository = new \Repository\User();
$userHydrator = new \Hydrator\User();

$restaurant = null;
$comments = null;

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    $restaurant = "internal error";
    http_response_code(400);
} else {
    $id = $_GET['id_resto'];

    if ($id) {
        $restaurant = $restaurantRepository->findOneById($id);
        $restaurant = $restaurantHydrator->extract($restaurant);

        $comments = $commentRepository->findAllByResto($id);
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
        $restaurant = "error";
    }
}
$view = ['data' => $restaurant, 'comments' => $dataComment, 'session' => $_SESSION];
echo json_encode($view);