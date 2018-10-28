<?php
/**
 * Created by PhpStorm.
 * User: theo
 * Date: 28/10/18
 * Time: 12:11
 */
/**
 * Created by PhpStorm.
 * User: Lineal
 * Date: 27/10/2018
 * Time: 04:21
 */

    require_once __DIR__.'./../vendor/autoload.php';

    $repositorytransac = new \Transaction\Repository\Transaction();

    $transactions = $repositorytransac->findByCriteria("idutilisateur",3);
    echo '<script>console.log($transactions)</script>';


require_once '../view/transactions.php';
