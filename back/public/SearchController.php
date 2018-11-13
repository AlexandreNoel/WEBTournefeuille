<?php

use \Router\Router;

$pdo =\Database\DatabaseSingleton::getInstance();

$keywordRepository = new \Keyword\KeywordRepository($pdo);
$barRepository = new \Bar\BarRepository($pdo);
$keywordHydrator = new \Keyword\KeywordHydrator();
$barHydrator = new \Bar\BarHydrator();

Router::get('/api/addbar\?keywords\=(.+)', function($request) use($barHydrator) {
    // http://localhost:3000/api/addbar?keywords=%22o%22
    // query execution - get data
    $keywords = urldecode($request->params[0]);
    $ch = curl_init();

    $location='48.8566,2.3522'; // centre de Paris
    $radius='50000'; // max
    //$type='bar,night_club,point_of_interest,establishment';
    $type='bar|night_club';
    $key = 'AIzaSyBL5wwReFZULzsHE0wJSifX_g43OMWR2jo';
    $keyword= rawurlencode($keywords);

    $url = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?';
    $url .= 'location='.$location.'&';
    $url .= 'radius='.$radius.'&';
    $url .= 'type='.$type.'&';
    $url .= 'keyword='.$keyword.'&';
    $url .= 'key='.$key;

    curl_setopt($ch, CURLOPT_URL, $url);
    // Set so curl_exec returns the result instead of outputting it.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Get the response and close the channel.
    $response = curl_exec($ch);
    $arrayResponse = json_decode($response,true);

    curl_close($ch);

    // récupération des bars
    $bars = [];
    foreach ($arrayResponse['results'] as $value) {

        // j'ai mis une photo par defaut d'un bar random
        $photoref = "CmRaAAAAFIU2P46W3fs6FBBRy4gfBBES5jpW44KZIseyOVmPGqZDd5T6Lq2Zw2y31Acreo0z0ZwVSOsQ8wj2zU6vhuuk3Z2fMFqJQcrxFtg5OuirPk69_leTfz4I05G1QX2CfwYtEhBkjxDP2f71cXP8QgBOxFTrGhQFSr77AIsNSG-mAIiFDWyP7kISvg";
        if(array_key_exists('photos',$value)){
            $photoref = $value['photos'][0]['photo_reference'];
        }
        $rating = -1;
        if(array_key_exists('rating', $value)){
            $rating = $value['rating'];
        }
        $tmp_bar = (new \Bar\Bar())
            ->setId(-1)
            ->setName($value["name"])
            ->setPhoto($photoref)
            ->SetRating($rating)
            ->SetAddress($value['vicinity'])
            ->setPlaceId($value['place_id'])
            ->setLat($value["geometry"]['location']['lat'])
            ->setLng($value["geometry"]['location']['lng']);
        array_push($bars,$tmp_bar);
    }

    if (!$bars) return http_response_code(500);

    echo json_encode($barHydrator->extractAll($bars), JSON_UNESCAPED_UNICODE);
});

Router::post('/api/addbar', function($request) use($barRepository, $barHydrator) {
    if (is_null($request->body->data)) return http_response_code(400);

    $bar = $request->body->data->bar;
    $list = $request->body->data->list;
    $pseudo = $request->body->data->userPseudo;
    $barId = $barRepository->isStored($bar->placeId);
    if($barId == null) {
        // inserrer le bar et retourner son id
        $tmpBar = (new \Bar\Bar())
            ->setName($bar->name)
            ->setPhoto($bar->photoReference)
            ->SetRating($bar->rating)
            ->SetAddress($bar->address)
            ->setLat($bar->lat)
            ->setLng($bar->lng)
            ->setPlaceId($bar->placeId);
        $barId = $barRepository->createBar($tmpBar);
    }
    // ajout du bar
    // TODO : verifier qu'il n'est pas deja liké
    $barRepository->addBarInList($pseudo,$barId,$list);
});
