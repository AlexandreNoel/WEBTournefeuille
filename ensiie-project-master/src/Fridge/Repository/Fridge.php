<?php
namespace Fridge\Repository;
include_once '../../src/Fridge/Hydrator/Fridge.php';
include_once '../../src/Adapter/DatabaseFactory.php';
include_once '../../src/Fridge/Entity/Fridge.php';
class Fridge{
    public function __construct()
    {
        $this->hydrator = new \Fridge\Hydrator\Fridge();
        $this->dbAdapter = new \Adapter\DatabaseFactory();
        $this->dbAdapterFunction= $this->dbAdapter->getDbAdapter();

    } 
    public function Consumed(){
        try{
            $statement=$this->dbAdapterFunction->prepare('select count(*) from "consumed"');
            $statement->execute();
            $countConsumed = $statement->fetchAll(\PDO::FETCH_OBJ); 
            return json_encode($countConsumed);
        }catch(PDOException $ex){
            echo $ex->getMessage();
        }
    }
    public function lookInFridge(){
    try{
        $statement=$this->dbAdapterFunction->prepare('select * from "food"  as f where f.idfood not in (select idfood from "consumed" as a)');
        $statement->execute();
        $rows = $statement->fetchAll(\PDO::FETCH_OBJ); 
        return json_encode($rows);
    }catch(PDOException $ex){
        echo $ex->getMessage();
    }
    }
    public function createFridge(\Fridge\Entity\Fridge $fridge){
        try{
        $taskArray = $this->hydrator->extract($fridge);
        $statement = $this->dbAdapter->prepare('insert into "fridge"(dateOfClean)VALUES(:dateOfClean)');
        $statement=$this->dbAdapter->bindParam(':dateOfClean',$taskArray["cleanDate"]);
        $statement->execute();
        echo 'Success';
        }catch(PDOException $ex){
            echo $ex->getMessage();
        }

    }
}



?>