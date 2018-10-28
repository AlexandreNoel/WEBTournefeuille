<?php

require '../vendor/autoload.php';

$userRepository = new \Repository\User();
$userHydrator = new \Hydrator\User();

if (!($_SERVER['REQUEST_METHOD'] === 'POST')) {
    echo "internal erro POST";
    require_once('view/connect.php'); 
    return;
}
$mail= $_POST['mail'] ?? null;
$user = $userRepository->findOneByMail($mail);
if(!isset($user)){
  echo "error";
  require_once('view/connect.php'); 
  return;
}

$password = "test";
$user->setPassword(password_hash($password, PASSWORD_DEFAULT));

$userRepository->updatePassword($user);
$to = $mail;
$subject = "Your Recovered Password";
$message = "Please use this password to login " . $password;
$headers = "From : phat-advisor@burger.com";
mail($to, $subject, $message, $headers); // todo : need to test
header('Location: index.php');