<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$restoRepository = new \Repository\Restaurant();
$catRepository = new \Repository\Categorie();
$restoHydrator = new \Hydrator\Restaurant();


$restos = [];

    $restos = $restoRepository->findAllNoDeleted();
    $dataCats = [];
    $rowcats = $catRepository->fetchAll();
    foreach ($rowcats as $cat) {
        $dataCats[] = $cat->getName();
    }

    foreach ($restos as $resto) {
        $data[] = $restoHydrator->extract($resto);
    }
    $dat = ['resto' => $data, 'cats' => $dataCats];
    

echo json_encode($dat);









