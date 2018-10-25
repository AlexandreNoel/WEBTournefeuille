<?php

require '../vendor/autoload.php';


$restoRepository = new \Repository\Restaurant();
$restoHydrator = new \Hydrator\Restaurant();


$restos = [];

if (isset($_SESSION['isadmin'])  && $_SESSION['isadmin']){
    $restos = $restoRepository->fetchAll();
}else {
    $restos = $restoRepository->findAllNoDeleted();
}

if (isset($_SESSION['name'])) {
    // Todo: add favorite in array
    //$favorites = getFavoriteByName();
}

$restos_encode = json_encode($restos);

