<?php

require '../vendor/autoload.php';

session_start();

$restoRepository = new \Repository\Restaurant();
$restoHydrator = new \Hydrator\Restaurant();



$restos = $restoRepository->findAllNoDeleted();

foreach ($restos as $resto) {
    $view[$resto->getId()] = [
        'nom_resto' => $resto->getName() ?? null,
        'addr_resto' => $resto->getAddress() ?? null,
        'city_resto' => $resto->getCity() ?? null,
    ];
}

if (isset($_SESSION['name'])) {
    // Todo: add favorite in array
    //$favorites = getFavoriteByName();
    $view
}
if()

$resto_view = json_encode($view);

var_dump($resto_view);
var_dump($view);
