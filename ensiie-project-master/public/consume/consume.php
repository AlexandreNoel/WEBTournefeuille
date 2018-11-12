<?php
include_once '../../src/Food/Repository/Consumed.php';
if($_SERVER['REQUEST_METHOD']==='POST')
{ 
    $idfood = $_POST["idfood"];
    $id = $_POST["id"];
    $consume = new \Consumed\Food\Consumed();
    $result = $consume->consumeProduct($id,$idfood);
    echo $result;
}
?>