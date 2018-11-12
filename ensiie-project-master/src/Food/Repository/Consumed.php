<?php
namespace Consumed\Food;
include_once '../../src/Adapter/DatabaseFactory.php';
class Consumed{

    public function __construct()
    {
        $this->dbAdapter = new \Adapter\DatabaseFactory();
        $this->dbAdapterFunction= $this->dbAdapter->getDbAdapter();
    }
    public function consumeProduct($idP,$idfood)
    {

    try{      
            $statement=$this->dbAdapterFunction->prepare('INSERT INTO "consumed"(idfood,id) VALUES (:idfood,:id)');
            $statement->bindParam(':id',$idP);
            $statement->bindParam(':idfood',$idfood);
            $statement->execute();
            return '';
        }catch(PDOException $ex)
        {
            $ex->getMessage();
        }

    }
}
?>