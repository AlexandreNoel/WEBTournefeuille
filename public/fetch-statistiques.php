<?php
/**
 * Created by PhpStorm.
 * User: Theo (et non c'est lineal)
 * Date: 25/10/2018
 * Time: 23:04
 */

require_once __DIR__.'./../vendor/autoload.php';

session_start();
if(!isset($_SESSION['authenticated_user'])){
    header('Location: /');
}
else{

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset(
            $_POST["idutilisateur"])){
            $hydrator = new Transaction\Hydrator\Transaction();
            $repoptransac = new Transaction\Repository\Transaction();
            $user = $_SESSION["authenticated_user"];

            $myarray= $repoptransac->getStatistiques($user->getId());
            echo json_encode($myarray);

        }
    }
    else {
        throw new \HttpInvalidParamException('Method not allowed', 405);
    }
}
exit();
