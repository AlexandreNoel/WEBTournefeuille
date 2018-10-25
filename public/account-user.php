<?php
require '../vendor/autoload.php';

session_start();

$userRepository = new \Repository\User();

if (isset($_SESSION['id'])){
    $id_user = $_SESSION['id'];
    $user = $userRepository->findOneById($id_user);

    require_once('view/account-user.php');
}