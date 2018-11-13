<?php
use \Router\Router;

$pdo = \Database\DatabaseSingleton::getInstance();
$userHydrator = new \User\UserHydrator();
$userRepository = new \User\UserRepository($pdo);

Router::post('/api/login', function($request) use($userRepository, $userHydrator) {
    if (is_null($request->body) || !(isset($request->body->password)) || (strlen($request->body->password) < 3)) return http_response_code(400);

    $login = $request->body->login;
    $user = $userRepository->fetchByLogin($login);

    if (!$user) return http_response_code(401);
    if(!password_verify($request->body->password,$user->getHash())) return http_response_code(401);

    $token = \Token\JwtHS256::generate($user, getenv('SECRET'), time() + (60 * 30));

    header("Authorization: Bearer $token");
    echo json_encode($userHydrator->extract($user));
});
