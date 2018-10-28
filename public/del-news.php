<?php
/**
 * Created by PhpStorm.
 * User: Lineal
 * Date: 25/10/2018
 * Time: 23:06
 */

require_once __DIR__.'./../vendor/autoload.php';
session_start();
if(!isset($_SESSION['authenticated_user'])){
    header('Location: /');
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["id_annonce"]))
    {
        $repoproducts = new News\Repository\News();
        $repoproducts->delete($_POST["id_annonce"]);
    }
} else {
    throw new \HttpInvalidParamException('Method not allowed', 405);
}
header('Location: news.php');
exit();
