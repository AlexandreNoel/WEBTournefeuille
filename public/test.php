<?php

require_once __DIR__."/../vendor/autoload.php";

$user = new \Client\Entity\Client();

$user->setSolde(3.253454355);

echo $user->getSolde();