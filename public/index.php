<?php
// Récupération de l'url demandé
$url = $_SERVER['REQUEST_URI'];


// Redirection
switch ($url) {

    /* WELCOME */
    case '/':
        require __DIR__ . '/../view/welcome.php';
        break;
    case '/welcome.php':
        require __DIR__ . '/../view/welcome.php';
        break;

    /* ABOUT */
    case '/about' :
        require __DIR__ . '/../view/about.php';
        break;

    case '/login' :
        require __DIR__ . '/login.php';
        break;

    /* HOME */
    case '/home':
        require __DIR__ . '/home.php';
        break;

    /* CONSOLE */
    case '/console':
        require __DIR__ . '/console.php';
        break;

    case '/services':
        require __DIR__ . '/services.php';
        break;

    /* AUTRES CAS NON GERE */
    default:
        require __DIR__ . '/../view/404.php';
        break;
}
