<?php
 include_once '../../src/Fridge/Repository/Fridge.php';
if($_SERVER['REQUEST_METHOD']==='POST')
{
    $fridge = new \Fridge\Repository\Fridge();
    $rows = $fridge->lookInFridge();
    $available = $fridge->Consumed();
    $datas = [
        'available'=>$available,
        'datasFridge'=>$rows
    ];
    echo json_encode($datas);
}
?>