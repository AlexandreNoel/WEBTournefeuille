<?php
namespace Mail\Food;
include_once '../src/Adapter/DatabaseFactory.php';
class Mail{

  public function __construct()
  {
      $this->dbAdapter = new \Adapter\DatabaseFactory();
      $this->dbAdapterFunction= $this->dbAdapter->getDbAdapter();
  }
   function checkExpirateProducts(){
    try{
        $statement=$this->dbAdapterFunction->prepare("select * from food where expirationdate between (select now() - interval '2 DAY') and (select now())");
        $statement->execute();
        $products=$statement->fetchAll();
        return $products;
    }catch(PDOException $ex){
        echo $ex->getMessag();
    }
}

}
  



?>