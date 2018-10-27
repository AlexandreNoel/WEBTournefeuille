<?php
$uri = $_SERVER['REQUEST_URI'];
if (preg_match('/^\/form\/?$/', $uri)) {
    $pagePath = 'form.html';
} elseif (preg_match('/^\/burgers\/?$/', $uri)) {
    $pagePath = 'burgers.html';
} elseif (preg_match('/^\/burgers\/[0-9]+\/?$/', $uri)) {
    $pagePath = 'burgers.html';
} elseif (preg_match('/^\/add-restaurant\/?$/', $uri)) {
    $pagePath = 'add-restaurant.html';
} elseif (preg_match('/^\/update-user\/?$/', $uri)) {
    $pagePath = 'update-user.html';
}else {
    $pagePath = '404.html';
} 
include('template.php');
?>
