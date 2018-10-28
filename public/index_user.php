<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();


$userRepository = new \Repository\User();
$userHydrator = new \Hydrator\User();

$users = $userRepository->fetchAll();

echo json_encode($users);