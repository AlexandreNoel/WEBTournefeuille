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
        if (isset($_POST["methode"])){
            if($_POST["methode"]==="piechart"){

                $hydrator = new Transaction\Hydrator\Transaction();
                $repoptransac = new Transaction\Repository\Transaction();
                $user = $_SESSION["authenticated_user"];

                $myarray= $repoptransac->getStatistiques($user->getId());
                echo json_encode($myarray);
            }

            else {
                if ($_POST["methode"]==="chart") {
                    $repoptransac = new Transaction\Repository\Transaction();
                    $repouser = new Client\Repository\Client();
//                    $user = $_SESSION["authenticated_user"];
                    $user = $repouser->findOneById(2);
                    $mysolde=$user->getSolde();
                    $myarray= $repoptransac->getEvolutionSolde($user->getId());
                    foreach ($myarray as $elem){
                        $mysolde-=$elem['credit'];
                        $mysolde+=$elem['debit'];
//                        $data['date']=strtotime($elem['date']);
//                        $data['value']=$mysolde;
                        $data[0]=strtotime($elem['date'])*1000;
                        $data[1]=$mysolde;
                        $res[]=$data;
                    }
//                    echo json_encode($myarray);
//                    echo $mysolde;
                    echo json_encode($res);
                }
            }
        }
    }
    else {
        throw new \HttpInvalidParamException('Method not allowed', 405);
    }
}
exit();
