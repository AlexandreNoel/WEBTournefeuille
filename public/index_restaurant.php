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


echo json_encode($restos);

