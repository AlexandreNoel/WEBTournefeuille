<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

//SessionChecker::redirectIfNotAdmin();

$userRepository = new \Repository\User();

$error = [];
if ($_SERVER['REQUEST_METHOD'] === 'PUT' && (isset($_SESSION['isadmin']))) {
    parse_str(file_get_contents("php://input"),$post_vars);

    $id_user = $post_vars['id_user'] ?? null;

    $isadmin = $userRepository->checkRightById($id_user);
    $result['data'] = $userRepository->updateRight($isadmin,$id_user);
    if($_SESSION && $result){
        $result['errorcode'] = "200";
    }else{
        $result['errorcode'] = "400";
        http_response_code(400);
    }

    echo json_encode($result);
}
