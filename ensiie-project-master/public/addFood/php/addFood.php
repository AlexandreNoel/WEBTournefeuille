<?php
  include_once '../../../src/Food/Hydrator/FoodHydrator.php';
  include_once '../../../src/Food/Repository/FoodRepository.php';
  include_once '../../../src/Food/Entity/FoodEntity.php';
if($_SERVER['REQUEST_METHOD']==='POST')
{ 
    session_start();
    $foodHydratorUser = new \Food\Hydrator\Food();
    $foodRepositoryUser = new \Food\Repository\Food();
    $view = ['food'=>[]];
    $name = $_POST["name1"] ?? null; 
    $type = $_POST['type1'] ?? null;
    $date = $_POST['date1']?? null;
    $price = $_POST['price1']?? null;
    $quantity = $_POST['quantity1']?? null;
    $codeBarre = $_POST['codeBarre']??null;  
    $idParent = $_POST["idParent"];


    $newFood = $foodHydratorUser->hydrate(
        [
            'name'=>$name,
            'type'=>$type,
            'date'=>$date,
            'price'=>$price,
            'quantity'=>$quantity,
            'codebarre'=>$codeBarre,
            'idParent'=>$idParent
        ],new \Food\Entity\Food());

        $foodRepositoryUser->createFood($newFood,$idParent);
}
?>