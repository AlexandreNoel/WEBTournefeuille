<?php
$uri = $_SERVER['REQUEST_URI'];

if (preg_match('/^\/burgers\/?$/', $uri)) {
    $pagePath = 'burgers.html';
} elseif (preg_match('/^\/burgers\/[0-9]+\/?$/', $uri)) {
    $pagePath = 'burgers.html';
} else {
    $pagePath = '404.html';
} 
include('template.php');
?>
