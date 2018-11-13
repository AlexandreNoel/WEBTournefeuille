<?php

use \Router\Router;
use \Token\JwtHS256;

$pdo = \Database\DatabaseSingleton::getInstance();
$userHydrator = new \User\UserHydrator();
$userValidator = new \User\UserValidator();
$userRepository = new \User\UserRepository($pdo);

Router::get('/api/users/{}', function() use($userRepository, $userHydrator) {
    if (!array_key_exists('HTTP_AUTHORIZATION', $_SERVER)) {
        http_response_code(401);
        echo json_encode(['error' => 'You are not authorized without JWT']);
        return;
    }

    [, $token] = explode(' ', $_SERVER['HTTP_AUTHORIZATION']);

    try {
        $jsonUser = JwtHS256::validate($token, getenv('SECRET'));
        $user = $userRepository->fetchById($jsonUser->id);
        echo json_encode($userHydrator->extract($user));
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['error' => $e->getMessage()]);
    }
});

Router::post('/api/users', function($request) use($userRepository, $userValidator) {
    if (!$userValidator->validate($request->body)) {
        return http_response_code(400);
    }

    $hash = password_hash($request->body->password,PASSWORD_BCRYPT);

    $user = (new \User\User())
        ->setEmail(strtolower($request->body->email))
        ->setHash($hash)
        ->setPseudo($request->body->pseudo)
        ->setRole('USER');

    if(!$userRepository->isValidUser($user)) {
        http_response_code(400);
        echo json_encode(['error' => 'Email or pseudo already exist']);
        return;
    }

    if(!$userRepository->createUser($user)) {
        return http_response_code(500);
    } else {
        return http_response_code(201);
    }
});

Router::put('/api/users/{}', function($request) use($userRepository) {
    if (!array_key_exists('HTTP_AUTHORIZATION', $_SERVER)) {
        http_response_code(401);
        echo json_encode(['error' => 'You are not authorized without JWT']);
        return;
    }

    [, $token] = explode(' ', $_SERVER['HTTP_AUTHORIZATION']);

    try {
        $jsonUser = JwtHS256::validate($token, getenv('SECRET'));
        $user = $userRepository->fetchFullById($jsonUser->id);
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['error' => $e->getMessage()]);
        return;
    }

    // Check parameter
    if (is_null($request->body) || !(isset($request->params[0]) && isset($request->body->password) && isset($request->body->currentPassword))) return http_response_code(400);

    // Get all the information from the body
    $str_id = $request->params[0];
    $id = ctype_digit($str_id) ? intval($str_id) : null;
    if ($id === null)
    {
        return http_response_code(400);
    }

    if($user->getId() != $id)
    {
        return http_response_code(401);
    }

    $current_password = $request->body->currentPassword;
    if(!password_verify($current_password,$user->getHash()))
    {
        return http_response_code(403);
    }

    $new_password = $request->body->password;

    if(strlen($new_password) < 3) return http_response_code(400);

    $new_hash = password_hash($new_password,PASSWORD_BCRYPT);
    if($userRepository->updatePassword($id, $new_hash))
    {
        return http_response_code(200);
    }
    else
    {
        return http_response_code(500);
    }

});


Router::post('/api/users/{}/keywords', function($request) use($userRepository, $keywordRepository, $keywordHydrator) {
    if (!array_key_exists('HTTP_AUTHORIZATION', $_SERVER)) {
        http_response_code(401);
        echo json_encode(['error' => 'You are not authorized without JWT']);
        return;
    }

    [, $token] = explode(' ', $_SERVER['HTTP_AUTHORIZATION']);

    try {
        $jsonUser = \Token\JwtHS256::validate($token, getenv('SECRET'));
        $user = $userRepository->fetchFullById($jsonUser->id);
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['error' => $e->getMessage()]);
        return;
    }

    if(!(!is_null($request->body->keywordsIds) && isset($request->params[0]) && is_array($request->body->keywordsIds) && count($request->body->keywordsIds) > 0)) return http_response_code(400);

    // Get all the information from the body
    $str_id = $request->params[0];
    $user_id = ctype_digit($str_id) ? intval($str_id) : null;
    if ($user_id == null)
    {
        return http_response_code(400);
    }

    $keywords_ids = $request->body->keywordsIds;

    if(count($keywords_ids) < 1) return http_response_code(400);

    // Check if authorized or not
    if($user_id != $user->getId()){
        return http_response_code(401);
    }

    // Insert thoses keyword_ids inside the keyword inside the table keyuser
    if($keywordRepository->addKeywordsByUser($user_id,$keywords_ids))
        return http_response_code(200);
    else
        return http_response_code(500);

});

Router::delete('/api/users/{}/keywords/{}', function($request) use($userRepository, $keywordRepository, $keywordHydrator) {
    if (!array_key_exists('HTTP_AUTHORIZATION', $_SERVER)) {
        http_response_code(401);
        echo json_encode(['error' => 'You are not authorized without JWT']);
        return;
    }

    [, $token] = explode(' ', $_SERVER['HTTP_AUTHORIZATION']);

    try {
        $jsonUser = \Token\JwtHS256::validate($token, getenv('SECRET'));
        $user = $userRepository->fetchFullById($jsonUser->id);
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['error' => $e->getMessage()]);
        return;
    }

    if(!(isset($request->params[0]) && isset($request->params[1]))) return http_response_code(400);

    // Get all the information from the body
    $str_user_id = $request->params[0];
    $user_id = ctype_digit($str_user_id) ? intval($str_user_id) : null;
    if ($user_id == null)
    {
        return http_response_code(400);
    }

    $str_keyword_id = $request->params[1];
    $keyword_id = ctype_digit($str_keyword_id) ? intval($str_keyword_id) : null;
    if ($keyword_id == null)
    {
        return http_response_code(400);
    }

    // Check if authorized or not
    if($user_id != $user->getId()){
        return http_response_code(401);
    }

    // Insert thoses keyword_ids inside the keyword inside the table keyuser
    if($keywordRepository->deleteKeywordByUser($user_id,$keyword_id))
        return http_response_code(200);
    else
        return http_response_code(500);

});
