<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$userRepository = new \Repository\User();

$error = [];
if ($_SERVER['REQUEST_METHOD'] === 'PUT'/* && (isset($_SESSION['isadmin']))*/) {
    $id_user = $_POST['id_user'] ?? null;

    $isadmin = $userRepository->checkRightById($id_user);
    $userRepository->updateRight($isadmin,$id_user);

}
