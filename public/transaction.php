<?php

    require_once __DIR__.'./../vendor/autoload.php';

    $repositorytransac = new \Transaction\Repository\Transaction();

    $transactions = $repositorytransac->findByCriteria("idutilisateur",3);

require_once '../view/transaction.php';
