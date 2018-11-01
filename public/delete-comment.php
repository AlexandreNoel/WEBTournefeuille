<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$commentRepository = new \Repository\Comment();

$error = "null";

if ($_SERVER['REQUEST_METHOD'] !== "DELETE") {

    $error = "internal error";
    http_response_code(400);
}else{
    parse_str(file_get_contents("php://input"), $post_vars);
    $id = $post_vars['id_comment'] ?? null;
    
    if ($id) {
        $comment = $commentRepository->findOneById($id);
        $isDeleted = $commentRepository->delete($comment);

        $error = "deleted";
    }else{
        $error = "not deletd";
        http_response_code(400);
    }
}
echo json_encode($error);