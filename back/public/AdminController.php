<?php

use \Router\Router;

$pdo = \Database\DatabaseSingleton::getInstance();

$commentHydrator = new \Comment\CommentHydrator();
$commentRepository = new \Comment\CommentRepository($pdo);

$userRepository = new \User\UserRepository($pdo);

Router::get('/api/admin/comments', function($request) use($userRepository, $commentHydrator, $commentRepository)
{
    if (!array_key_exists('HTTP_AUTHORIZATION', $_SERVER)) {
        http_response_code(401);
        echo json_encode(['error' => 'You are not authorized without JWT']);
        return;
    }

    [, $token] = explode(' ', $_SERVER['HTTP_AUTHORIZATION']);

    try {
        $jsonUser = \Token\JwtHS256::validate($token, getenv('SECRET'));
        $user = $userRepository->fetchFullById($jsonUser->id);
        if($user->getRole() !== 'ADMIN'){
            http_response_code(401);
            echo json_encode(['error' => 'Vous avez besoin de privilèges administrateur pour accèder cette information.']);
            return;
        }
        $comments = $commentRepository->fetchAll();
        if(!$comments) return http_response_code(404);
        echo json_encode($commentHydrator->extractAll($comments), JSON_UNESCAPED_UNICODE);
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['error' => $e->getMessage()]);
        return;
    }
});

