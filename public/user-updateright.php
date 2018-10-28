<?php
require '../vendor/autoload.php';

session_start();

$userRepository = new \Repository\User();

$error = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_SESSION['isadmin']))) {
    $id_user = $_POST['id_user'] ?? null;

    $isadmin = $userRepository->checkRightById($id_user);
    $userRepository->updateRight($isadmin,$id_user);

}
