<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$userRepository = new \Repository\User();

$error = [];
if ($_SERVER['REQUEST_METHOD'] === 'PUT'/* && (isset($_SESSION['isadmin']))*/) {
    parse_str(file_get_contents("php://input"),$post_vars);

    $id_user = $post_vars['id_user'] ?? null;

    $isadmin = $userRepository->checkRightById($id_user);
    $result = $userRepository->updateRight($isadmin,$id_user);

    echo json_encode($result);
}
