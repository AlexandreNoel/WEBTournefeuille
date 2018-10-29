<?php

namespace api;
require '../vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$uri = $_SERVER['REQUEST_URI'];
$httpMethod=$_SERVER['REQUEST_METHOD'];

$rawParams=explode("/",$uri);
$params=array_slice($rawParams,2);
$entity=$params[0];
$entityId = count($params) > 1 ? $params[1] : null;


// Construction de la liste des API (Correspond à la liste des repositories)
$availableApiFiles=scandir("../src/Repository");
$availableApis=[];

foreach($availableApiFiles as $file){
    if (!preg_match('/^\.(.*)$/', $file)){ //|| ($file !="..")){
        $availableApis[]=strtolower(str_replace(".php","",$file));
    }
}

// Chech si l'entité voulue est disponible sur l'API
$isRequestAvailable=in_array($entity,$availableApis);
if (!$isRequestAvailable){
    echo json_encode(array('message' => 'Requested API not available: '.$entity,
    'usage'=>array(
        '/api/entityName/id' => 'Returns a JSON of the entity with the specified id',
        '/api/entityName' => 'Returns a JSON with all the entities designed by entityName'),
    'available-apis' => $availableApis));
    exit;
}

$entityClassName= "\\Repository\\$entity";
$entityHydratorName="\\Hydrator\\$entity";
$entityRepository = new $entityClassName();
$entityHydrator = new $entityHydratorName();    

switch($httpMethod){

    case 'GET':
        if ($entityId !== null){
            // GET     Récuperation un Element     /api/v1/contact/{id}
            $methodName="findOneById";
            $resultData = $entityHydrator->extract($entityRepository->$methodName($entityId));
        }
        else{
        // GET     Récupération Collection     /api/v1/contact
            $methodName="fetchAll";
            $datas=$entityRepository->$methodName();
            $resultData=[];
            foreach($datas as $data){
                $resultData[]=$entityHydrator->extract($data);
            }
        }
        break;
    case 'POST':
        // POST     Creation d’Elements     /api/v1/contact
        break;
    case 'PUT':
        // PUT     Modifier un Element     /api/v1/contact/{id}
        break;
    case "DELETE":
        // DELETE     Effacer Element     /api/v1/contact/{id}
        break;
    default:
        echo json_encode(array("message"=>"Invalid HTTP VERB SPECIFIED"));
        exit;

}

//var_dump($resultData);
echo json_encode($resultData);
?>
