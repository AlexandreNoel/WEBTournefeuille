<?php

require '../vendor/autoload.php';


$restoRepository = new \Repository\Restaurant();
$catRepository = new \Repository\Categorie();
$restoHydrator = new \Hydrator\Restaurant();


$restos = [];

if (isset($_SESSION['isadmin'])  && $_SESSION['isadmin']){
    $restos = $restoRepository->fetchAll();
}else {
    $restos = $restoRepository->findAllNoDeleted();
}


$dataCats = [];

$rowcats = $catRepository->fetchAll();


foreach ($rowcats as $cat) {

    $dataCats[] = $cat->getName();
}

foreach ($restos as $resto) {

    $data[] =  $restoHydrator->extract($resto);
}
$dat = ['resto' => $data, 'cats' => $dataCats];

echo json_encode($dat);

