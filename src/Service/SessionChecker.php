<?php
namespace Service;


class SessionChecker{

    public static function redirectIfNotConnected(){
        if(!isset($_SESSION['id'])){
            echo json_encode(array("message" => "User not connected","errorcode" => "401"));
            http_response_code(401);
            exit;
        }

    }

    public static function redirectIfNotAdmin(){
        if(!$_SESSION ['isadmin']){
            echo json_encode(array("message" => "No access right", "errorcode" => "403"));
            http_response_code(403);
            exit;
        }
    }

    public static function redirectIfNotPermited($entityId)
    {
        if($_SESSION['isadmin'] == "true"){
            return;
        }
        if ($_SESSION['id'] != $entityId) {
            echo json_encode(array("message" => "No access right", "errorcode" => "403"));
            http_response_code(403);
            exit;
        }
    }

    public static function redirectDoesntExist($entityId,$entity,$val)
    {

        if (is_null($val)) {
            echo json_encode(array("$entity+' with id '+$entityId+' does not exist'", "errorcode" => "410"));
            http_response_code(410);
            exit;
        }
    }


}