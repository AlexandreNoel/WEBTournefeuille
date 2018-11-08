<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$res = "null";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $res = "internal error POST";
  http_response_code(400);
} else{
  if(isset($_SESSION['id'])){
        $res = "session already synchronized with server";
    exit();
  }
    $session = json_decode($_POST['session'],true);

    $_SESSION['uniqid'] = $session['uniqid'];
    $_SESSION['name'] = $session['name'];
    $_SESSION['id'] = $session['id'];
    $_SESSION['isadmin'] = $session['isadmin'];

    $res =  "session succesfully synchronized with server";

  }

echo json_encode($res);
