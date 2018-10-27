<?php

$uri = $_SERVER['REQUEST_URI'];
$httpMethod=$_SERVER['REQUEST_METHOD'];

$rawParams=explode("/",$uri);
$params=array_slice($rawParams,2);
$entity=$params[0];
$entityId = count($params) > 1 ? $params[1] : null;

if ($httpMethod === 'GET'){
    echo $httpMethod;
}
else if ($httpMethod === 'POST'){
    // TODO
}


//var_dump($params);
/*
$params[O] correspond à l'entité
$params[1] correspond à l'id de l'entité

GET     Récup. tous les liens     /api/v1/
GET     Récuperation un Element     /api/v1/contact/{id}
GET     Récupération Collection     /api/v1/contact
POST     Creation d’Elements     /api/v1/contact
DELETE     Effacer Element     /api/v1/contact/{id}
PUT     Modifier un Element     /api/v1/contact/{id}
PATCH     Modif. partielle d’Elt.     /api/v1/contact/{id} // pas utile
*/

echo json_encode([$entity,$entityId]);
?>
