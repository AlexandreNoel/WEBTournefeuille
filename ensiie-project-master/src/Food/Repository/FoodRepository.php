<?php
namespace Food\Repository;
include_once '../../../src/Food/Hydrator/FoodHydrator.php';
include_once '../../../src/Adapter/DatabaseFactory.php';
include_once '../../../src/Food/Entity/FoodEntity.php';
class Food
{
    /**
     * @var \PDO
     */


    /**
     * UserRepository constructor.
     * @param \PDO $connection
     */

    public function __construct()
    {
        $this->hydrator = new \Food\Hydrator\Food();
        $this->dbAdapter = new \Adapter\DatabaseFactory();
        $this->dbAdapterFunction= $this->dbAdapter->getDbAdapter();

    }
  
    public function createFood(\Food\Entity\Food $food,$idParent){
        try{
            $taskArray = $this->hydrator->extract($food); 
            $statement = $this->dbAdapterFunction->prepare('INSERT INTO "food"(Namef,Typet,ExpirationDate,Price,Quantity,CodeBarre) VALUES(:name,:type,:date,:price,:quantity,:codebarre) returning idFood');
            $statement->bindParam(':name',$taskArray["name"]);
            $statement->bindParam(':type',$taskArray["type"]);
            $statement->bindParam(':date',$taskArray["date"]);
            $statement->bindParam(':price',$taskArray["price"]);
            $statement->bindParam(':quantity',$taskArray["quantity"]);
            $statement->bindParam(':codebarre',$taskArray["codebarre"]);
            $statement->execute();
            $lastId = $this->dbAdapterFunction->lastInsertId();
            $statement=$this->dbAdapterFunction->prepare('INSERT INTO "watch"(idfood,id) VALUES (:lastId,:idParent)');
            $statement->bindParam(':lastId',$lastId);
            $statement->bindParam(':idParent',$idParent);
            $statement->execute();
            $statement=$this->dbAdapterFunction->prepare('INSERT INTO "add"(idfood,idparent) VALUES (:lastId,:idParent)');
            $statement->bindParam(':lastId',$lastId);
            $statement->bindParam(':idParent',$idParent);
            $statement->execute();
            echo 'Success';
        }catch(PDOException $ex){
            echo $ex->getMessage();
        }
    }

    public function printFood(){
        try{
        $statement=$this->dbAdapter->prepare('select * from "food"  as f where f.idfood not in (select idfood from "consumed" as a)');
        $statement->execute();
        $rows = $statement->fetchAll(\PDO::FETCH_OBJ); 
        return json_encode($rows);
    }catch(PDOException $ex){
        echo $ex->getMessage();
    }
}

}
?>