<?php

//namespace api;
require '../vendor/autoload.php';

$config = include('config/module.config.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$uri = $_SERVER['REQUEST_URI'];
$httpMethod=$_SERVER['REQUEST_METHOD'];

$rawParams=explode("/",$uri);
$params=array_slice($rawParams,2);
$entity=$params[0];
$entityId = count($params) > 1 ? $params[1] : null;

// Construction de la liste des API (Correspond à la liste des repositories)
$availableApis=array_keys($config);

// Chech si l'entité voulue est disponible sur l'API
$isRequestAvailable=in_array($entity,$availableApis);
if (!$isRequestAvailable){
    echo json_encode(array('message' => 'Requested API not available: '.$entity,
        'usage'=>array(
            '/api/entityName/id' => 'Returns a JSON of the entity with the specified id',
            '/api/entityName'    => 'Returns a JSON with all the entities designed by entityName'),
        'available-apis' => $availableApis));
    exit;
}

// Check si la methode http est autorisée pour l'entité
$isHttpMethodAvailable=in_array($httpMethod,$config[$entity]['api-methods']);

if (!$isHttpMethodAvailable){
    echo json_encode(
        array('message' => 'Invalid method API '.$httpMethod.' for entity '.$entity,
            "available-methods" => $config[$entity]['api-methods']
        )
    );
    exit;
}

$entityRepository = new $config[$entity]['repository']();
$entityHydrator = new $config[$entity]['hydrator']();

switch($httpMethod){
    case 'GET':
        if ($entityId !== null){
            // GET Récuperation un Element     /api/entity/{id}
            $methodName="findOneById";
            $resultData = $entityHydrator->extract($entityRepository->$methodName($entityId));

            // On traite les datas qui ne doivent pas être publiées
            foreach ($config[$entity]["GET-hidden-fields"] as $unwantedKey){
                if(in_array($unwantedKey,array_keys($resultData))) {
                    unset($resultData[$unwantedKey]);
                }
            }
        }
        else{
            // GET  Récupération Collection     /api/entity
            $methodName="fetchAll";
            $datas=$entityRepository->$methodName();
            $resultData=[];
            foreach($datas as $data){
                $extractedData = $entityHydrator->extract($data);

                // On traite les datas qui ne doivent pas être publiées
                foreach ($config[$entity]["GET-hidden-fields"] as $unwantedKey){
                    if(in_array($unwantedKey,array_keys($extractedData))) {
                        unset($extractedData[$unwantedKey]);
                    }
                }
                $resultData[]= $extractedData;
            }
        }

        break;
    case 'POST':
        // POST     Creation d’Elements     /api/entity
        include_once($config[$entity]['POST-action']);
        $resultData = array("status"=>"OK","message"=>"New Entity ".$entity." Created!");
        break;
    case 'PUT':
        // PUT     Modifier un Element     /api/entity/{id}
        if($entityId !== null){
            include_once($config[$entity]['PUT-action']);
            $resultData = array("status"=>"OK","message"=>$entity. "updated successfully");
        }
        else{
            $resultData = array("status"=>"KO","message"=>"You must specify an id for updating entity".$entity);
        }
        break;
    case "DELETE":
        // DELETE     Effacer Element     /api/entity/{id}
        if ($entityId !== null) {
            $entityToDel = $entityRepository->findOneById($entityId);
            $entityToDel->setIsDeleted(true);
            $isDeleted = $entityRepository->delete($entityToDel);
            $resultData = array("status"=>"OK","message"=>"Entity ".$entity." id #".$entityId." deleted!");
        }else{
            $resultData = array("status"=>"KO","message"=>" Error while trying to delete Entity ".$entity." id #".$entityId);
            http_response_code(400);
        }
        break;
    default:
        echo json_encode(array("message"=>"Invalid HTTP VERB SPECIFIED"));
        exit;
}
echo json_encode($resultData);
?>
