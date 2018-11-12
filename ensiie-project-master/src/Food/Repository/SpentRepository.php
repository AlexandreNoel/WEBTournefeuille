<?php
namespace Spent\Food;
include_once '../../src/Adapter/DatabaseFactory.php';
class Spent{

  public function __construct()
  {
      $this->dbAdapter = new \Adapter\DatabaseFactory();
      $this->dbAdapterFunction= $this->dbAdapter->getDbAdapter();
  }
  public function seeAllWasteProducts(){
    try{
        $statement=$this->dbAdapterFunction->prepare('select * from "waste"');
        //$statement->bindParam('table',$table);
        $statement->execute();
        $row = $statement->fetchAll();
        return  $row;
    }catch(PDOException $ex){
        echo $ex->getMessage();
    } 
  }
  public function seeAllProducts(){
    try{
        $statement=$this->dbAdapterFunction->prepare('select * from "food"');
        //$statement->bindParam('table',$table);
        $statement->execute();
        $row = $statement->fetchAll();
        return  $row;
    }catch(PDOException $ex){
        echo $ex->getMessage();
    }
  }

  public function printJustWasteProducts($idUser){
      try{
         $statement = $this->dbAdapterFunction->prepare(
          'select distinct namef,typet,price,expirationdate from "food" inner 
          join "waste" on food.idfood = waste.idfood inner join "userf" 
          on Userf.id = waste.id');
          //$statement->bindParam(':idUser',$idUser);
        $statement->execute();
        $products = $statement->fetchAll();
          return $products;
      }catch(PDOException $ex)
      {
          echo $ex->getMessage();
      }
  }
  public function printJustConsummedProducts($idUser){
    try{
       $statement = $this->dbAdapterFunction->prepare(
        'select  namef,typet,price,expirationdate from "food" inner 
        join "consumed" on food.idfood = consumed.idfood inner join "userf" 
        on Userf.id = consumed.id where userf.id =:idUser');
        $statement->bindParam(':idUser',$idUser);
      $statement->execute();
      $products = $statement->fetchAll();
        return $products;
    }catch(PDOException $ex)
    {
        echo $ex->getMessage();
    }
}

private function checkExpirateProducts(){
    try{
        $statement->$this->dbAdapterFunction->prepare('select * from "food" where expirationdate between (select now() - interval "2 DAY") and (select now())');
        $statement->execute();
        $products=$statement->fetchAll();
        return $products;
    }catch(PDOException $ex){
        echo $ex->getMessag();
    }
}
  

}


?>