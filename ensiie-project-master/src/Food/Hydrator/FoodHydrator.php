<?php
namespace Food\Hydrator;

include_once '../../../src/Food/Entity/FoodEntity.php';
/*
class Food

*/


class Food{

    public function extract(\Food\Entity\Food $foodObject):array {
        $data = [];
        if($foodObject->getDate()){
            $data["date"]=$foodObject->getDate();
        }
        if($foodObject->getName()){
            $data["name"] = $foodObject->getName();
        }
        if($foodObject->getPrice()){
            $data["price"]=$foodObject->getPrice();
        }
        if($foodObject->getType()){ 
            $data["type"] = $foodObject->getType();
        }
        if($foodObject->getQuantity()){
            $data["quantity"] = $foodObject->getQuantity();
        }
        if($foodObject->getCodeBarre()){
            $data["codebarre"] = $foodObject->getCodeBarre();
        }
        return $data;
    }



    public function hydrate(array $data, \Food\Entity\Food $emptyEntity):\Food\Entity\Food{
       
        $emptyEntity->setName($data["name"]?? null);
        $emptyEntity->setType($data["type"] ?? null);
        $emptyEntity->setPrice($data["price"] ?? null);
        $emptyEntity->setdate($data["date"] ?? null);
        $emptyEntity->setQuantity($data["quantity"] ?? null);
        $emptyEntity->setCodeBarre($data["codebarre"] ?? null);
        return $emptyEntity;
    }

}