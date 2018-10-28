<?php
include ("template.php");
require_once ('html/disconnected.html');

require '../vendor/autoload.php';
header("Access-Control-Allow-Origin: *");

session_start();
session_unset();
session_destroy();


