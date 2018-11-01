<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$restoRepository = new \Repository\Restaurant();
$catRepository = new \Repository\Categorie();
$restoHydrator = new \Hydrator\Restaurant();


$restos = [];

$restos = $restoRepository->findAllNoDeleted();
foreach ($restos as $resto) {
    $data[] = $restoHydrator->extract($resto);
}

$dataCats = [];
$cats = $catRepository->fetchAll();
foreach ($cats as $cat) {
    $dataCats[] = $cat->getName();
}

$dat = ['resto' => $data, 'cats' => $dataCats];

echo json_encode($dat);









