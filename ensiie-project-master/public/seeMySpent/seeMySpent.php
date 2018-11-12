<?php
include_once '../../src/Food/Repository/SpentRepository.php';
if($_SERVER['REQUEST_METHOD']==='POST')
{
    $table = $_POST["waste"];
    $foodToTable = $_POST["food"];
    $idUser=$_POST["idUser"];
    $food = new \Spent\Food\Spent();
    $waste = $food->seeAllWasteProducts();
    $spentMoney = $food->seeAllProducts();
    $price=0;
    $wasteProduct = $food->printJustWasteProducts($idUser);
    $consumedProduct = $food->printJustConsummedProducts($idUser);

  
    foreach($spentMoney as $money)
    {
        $price+=$money["price"];
    }

    $datas = [
        'countWaste'=>count($waste),
        'price'=>$price,
        'wasteProducts'=>$wasteProduct,
        'consumedProducts'=>$consumedProduct
    ];
 echo json_encode($datas);
  
}
?> 