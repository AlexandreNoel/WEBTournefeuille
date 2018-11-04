<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$commentRepository = new \Repository\Comment();
$commentHydrator = new \Hydrator\Comment();
$result = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['id'])) {
    $error = "internal error";
    http_response_code(400);

    $result = ['result' => 'error'];
} else {
    $newComment = $commentHydrator->hydrate(
        [
            'id_user_persons' => $_SESSION['id'] ?? null,
            'id_resto_restos' => $_POST['id_resto'] ?? null,
            'text_comment' => $_POST['text_comment'] ?? null,
            'date_comment' => (new \DateTime())->format(\DateTime::ATOM),
            'note_resto' => isset($_POST['note_resto']) ? $_POST['note_resto'] : null,
        ],
        new \Entity\Comment()
    );

    if (!$commentRepository->create($newComment)) {
        $result = ['result' => 'Error when creating new comment'];
        http_response_code(400);
    }else {
        $result = ['result' => 'succes'];
    }
}

echo json_encode($result);
