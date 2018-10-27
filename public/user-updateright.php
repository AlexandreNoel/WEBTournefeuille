<?php
require '../vendor/autoload.php';

session_start();

$userRepository = new \Repository\User();

$error = [];
if (!$_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = "request is not in post";
    require_once('view/users.php');
}else{

if (isset($_SESSION['isadmin'])) {
    $id_user = $_POST['id_user'];

    $isadmin = $userRepository->checkRightById($id_user);

    $userRepository->updateRight($isadmin,$id_user);

}
    header('Location: index_user.php');

}
