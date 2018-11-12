<?php
// Récupération de l'url demandé
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

// Redirection
switch ($request_uri[0]) {

    /* WELCOME */
    case '/':
        require __DIR__ . '/../view/welcome.php';
        break;
    case '/welcome.php':
        require __DIR__ . '/../view/welcome.php';
        break;

    /**********************/
    /* PARTIE UTILISATEUR */
    /**********************/
    // UTILISATEUR - LOGIN
    case '/login' :
        require __DIR__ . '/login.php';
        break;

    // UTILISATEUR - ACCUEIL
    case '/userInfo':
        require __DIR__ . '/userInfo.php';
        break;

    // UTILISATEUR - ACCUEIL
    case '/home':
        require __DIR__ . '/home.php';
        break;

    // UTILISATEUR - CATALOGUE
    case '/catalogue':
        require __DIR__ . '/catalogue.php';
        break;

    case '/news':
        require __DIR__ . '/news.php';
        break;

    // UTILISATEUR - STATS 
        case '/statistiques':
        require __DIR__ . '/statistiques.php';
        break;

    /*************************/
    /* PARTIE ADMINISTRATEUR */
    /*************************/
    // CONSOLE - LOGIN
    case '/connect-console':
        require __DIR__ . '/connect-console.php';
        break;

    // CONSOLE - ACCUEIL
    case '/console':
        require __DIR__ . '/console.php';
        break;

    // CONSOLE - GESTION - TRANSACTIONS
    case '/transaction':
        require __DIR__ . '/transaction.php';
        break;

    /* CONSOLE - GESTION - PRODUITS */
    case '/gestionProduct':
        require __DIR__ . '/gestionProduct.php';
        break;

    /* CONSOLE - GESTION - NEWS */
    case '/gestionNews':
        require __DIR__ . '/gestionNews.php';
        break;

    // CONSOLE - SERVICES (AJAX)
    case '/services':
        require __DIR__ . '/services.php';
        break;

    /*************************/
    /* AUTRES                */
    /*************************/
    default:
        require __DIR__ . '/../view/404.php';
        break;
}
