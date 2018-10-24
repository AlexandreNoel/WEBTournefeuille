<?php
    require '../vendor/autoload.php';


    if(session_status()!=PHP_SESSION_ACTIVE)
        session_start();
    //postgres
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    $username = "Sphinx06";
    $userFullName = "Xavier GRIMALDI";

    require_once('../view/consoleHome.php');
?>