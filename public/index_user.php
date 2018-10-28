<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();


$userRepository = new \Repository\User();
$userHydrator = new \Hydrator\User();

$users = $userRepository->fetchAll();

$data = [];
foreach ($users as $user) {
    $data[] = $userHydrator->extract($user);
}

echo json_encode($data);