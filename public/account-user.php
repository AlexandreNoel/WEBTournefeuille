<?php
require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$userRepository = new \Repository\User();

$user = "null";

if ($_SERVER['REQUEST_METHOD'] !== 'GET'/* || !isset($_SESSION['id'])*/) {
    $id_user = $_SESSION['id'];
    $user = $userRepository->findOneById($id_user);
} else {
    $user = "get error";
    http_response_code(400);
}

echo json_encode($user);