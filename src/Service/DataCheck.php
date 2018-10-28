<?php
namespace Service;

use  \Adapter\DatabaseFactory;

class DataCheck
{
    static function verify($data,$format_condition,$errorMsg,$dataname,$length_min,$length_max){
        if(isset($data) && !is_null($data) && $data != ''){
            if ($format_condition){
                return $errorMsg;
            }
            if (strlen($data) > $length_max) {
                return "Error: " . $dataname . " is too long (" . $length_max . " max)";
            }
            if (strlen($data) < $length_min) {
                return "Error: " . $dataname . " is too short (" . $length_min . " min)";
            }
        }else{
           return "Error: ". $dataname ." is required";
        }
        
    }


    static function verifyNotRequired($data, $condition, $errorMsg, $dataname, $length_min, $length_max)
    {
        if (isset($data) && !is_null($data) && $data != '') {
            if ($condition) {
                return $errorMsg;
            }
            if (strlen($data) > $length_max) {
                return "Error: " . $dataname . " is too long (" . $length_max . " max)";
            }
            if (strlen($data) < $length_min) {
                return "Error: " . $dataname . " is too short (" . $length_min . " min)";
            }
        } 
        
    }


}