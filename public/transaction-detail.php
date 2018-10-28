<?php
/**
 * Created by PhpStorm.
 * User: Theo (et non c'est lineal)
 * Date: 25/10/2018
 * Time: 23:04
 */

require_once __DIR__.'./../vendor/autoload.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset(
        $_POST["idcommande"])){
        $hydrator = new Transaction\Hydrator\Transaction();
        $repoptransac = new Transaction\Repository\Transaction();
        $products= $repoptransac->findProductsByCommande($_POST["idcommande"]);
        $myarray=[];
        $i=0;
        foreach ($products as $product){
            $productobj=$products->current();
            $ammount=$products->getInfo();
            $prixtotal=0;
            $prixtotal=$productobj->getPrice()*$ammount;
            $prixnet=$prixtotal-$prixtotal*$productobj->getReduction();
            $myarray[$i]=array("idcommande"=>$_POST["idcommande"],"idproduit"=>$productobj->getId(),"name"=>$productobj->getName(),
                "price"=>$productobj->getPrice(),"reduction"=>$productobj->getReduction(),"ammount"=>$ammount,"total"=>$prixnet);
            $i++;
        }
        echo json_encode($myarray);
    }
}
else {
    throw new \HttpInvalidParamException('Method not allowed', 405);
}
exit();
