<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();


$uri = $_SERVER['REQUEST_URI'];
if (preg_match('/^\/form\/?$/', $uri)) {
    $pagePath = 'form.html';
} elseif (preg_match('/^\/users\/?$/', $uri)) {
    $pagePath = 'users.html';
} elseif (preg_match('/^\/users\/[0-9]+\/?$/', $uri)) {
    $pagePath = 'update-user.html';
} elseif (preg_match ('/^\/restaurants\/update\/[0-9]+\/?$/', $uri)) {
    $pagePath = 'update-restaurant.html';
} elseif (preg_match('/^\/restaurants\/?$/', $uri)) {
    $pagePath = 'restaurants.html';
} elseif (preg_match('/^\/restaurants\/add\/?$/', $uri)) {
    $pagePath = 'add-restaurant.html';
} elseif (preg_match('/^\/restaurants\/[0-9]+\/?$/', $uri)) {
    $pagePath = 'restaurant.html';
} elseif ($uri === "/") {
    $pagePath = 'restaurants.html';
} elseif  (preg_match('/^\/disconnected\/?$/', $uri)) {
    $pagePath = 'disconnected.html';
} elseif  (preg_match('/^\/caroussel\/?$/', $uri)) {
    $pagePath = 'caroussel.html';
} elseif (preg_match('/^\/403\/?$/', $uri)) {
    $pagePath = '403.html';
} elseif (preg_match ('/^\/410\/?$/', $uri)) {
    $pagePath = '410.html';
} elseif (preg_match('/^\/503\/?$/', $uri)) {
    $pagePath = '503.html';
} else {
    $pagePath = '404.html';
}
include('template.php');
?>
