<?php
require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$userRepository = new \Repository\User();
$userHydrator = new \Hydrator\User();
$data = [];

if ($_SERVER['REQUEST_METHOD'] === 'GET'/* || !isset($_SESSION['id'])*/) {
    $id_user = $_GET['id_user'] ?? null;
    $user = $userRepository->findOneById($id_user);

    $data = $userHydrator->extract($user);

} else {
    $data = "get error";
    http_response_code(400);
}

echo json_encode($data);