<?php

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
session_start();

$uri = $_SERVER['REQUEST_URI'];
if (preg_match('/^\/form\/?$/', $uri)) {
    $pagePath = 'form.html';
} elseif (preg_match('/^\/add-restaurant\/?$/', $uri)) {
    $pagePath = 'add-restaurant.html';
} elseif (preg_match('/^\/update-user\/?$/', $uri)) {
    $pagePath = 'update-user.html';
} elseif (preg_match('/^\/restaurants\/?$/', $uri)) {
    $pagePath = 'restaurants.html';
} elseif (preg_match('/^\/restaurants\/[0-9]+\/?$/', $uri)) {
    $pagePath = 'restaurant.html';
} elseif ($uri === "/") {
    $pagePath = 'restaurants.html';
} else {
    $pagePath = '404.html';
}
include('template.php');
?>
