<?php
namespace Fridge\Hydrator;
include_once '../../src/Fridge/Entity/Fridge.php';
class Fridge{
    public function extract(\Fridge\Entity\Fridge $fridgeObject):array{
        $data = [];
        if($fridgeObject->getCleanDate()){
            $data["cleanDate"] = $fridgeObject->getCleanDate();
        }
        return $data;
    }
    public function hydrate(\Fridge\Entity\Fridge $emptyFridge,$data):\Fridge\Entity\Fridge{
        $emptyFridge->setCleanDate($data["cleanDate"] ?? null);
        return $emptyFridge;
    }
}
?>