<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$userRepository = new \Repository\User();
$userHydrator = new \Hydrator\User();

$error = "null";

if (!($_SERVER['REQUEST_METHOD'] === 'POST')) {
    $error = "internal erro POST";
  http_response_code(400);
} else{
  $mail = $_POST['mail'] ?? null;
  $user = $userRepository->findOneByMail($mail);
  if (!isset($user)) {
    $error = "internal error ";
    http_response_code(400);
  }

  $password = "test";
  $user->setPassword(password_hash($password, PASSWORD_DEFAULT));

  $userRepository->updatePassword($user);
  $to = $mail;
  $subject = "Your Recovered Password";
  $message = "Please use this password to login " . $password;
  $headers = "From : phat-advisor@burger.com";
  mail($to, $subject, $message, $headers); // todo : need to test
  $error = "no mail server";
}
echo json_encode($error);
