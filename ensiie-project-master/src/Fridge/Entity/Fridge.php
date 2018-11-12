<?php
namespace Fridge\Entity;

class Fridge{
private $id;
private $cleanDate;

public function setCleanDate($cleandate){
    $this->cleanDate = $cleandate;
    return $this;
}
public function getCleanDate(){
    return $this->cleanDate;
}
}
?>