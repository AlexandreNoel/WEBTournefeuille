<?php

session_start();
require '../vendor/autoload.php';


$userRepository = new \Repository\User();
$userHydrator = new \Hydrator\User();

$users = $userRepository->fetchAll();

echo json_encode($users);