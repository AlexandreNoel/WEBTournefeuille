<?php

use \Router\Router;

$pdo =\Database\DatabaseSingleton::getInstance();
$keywordRepository = new \Keyword\KeywordRepository($pdo);
$userRepository = new \User\UserRepository($pdo);
$keywordHydrator = new \Keyword\KeywordHydrator();

Router::get('/api/keywords', function() use($keywordRepository, $keywordHydrator) {
    $keywords = $keywordRepository->fetchAll();

    if (!$keywords) return http_response_code(500);

    echo json_encode($keywordHydrator->extractAll($keywords), JSON_UNESCAPED_UNICODE);
});
