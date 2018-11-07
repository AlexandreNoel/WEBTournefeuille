<?php
/** Connect en login demo */

require_once __DIR__.'./../vendor/autoload.php';

session_start();

$userRepository = new \Client\Repository\Client();
$user =  $userRepository->findOneByNickname("Demo");
$_SESSION["authenticated_user"] = $user;

header('Location: home');