<?php
require '../vendor/autoload.php';
include('menu.php');
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();
?>

<html>
<head>
    <title> Intendance  </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="style_index.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
menu_aperal();
?>

<h3><?php echo 'Intendance' ?></h3>

    <table class="table table-bordered table-hover table-striped">
        <thead style="font-weight: bold">
        <td>Soirée</td>
        <td>Liste des Courses</td>
        <td>Participants</td>
        </thead>

  <?php 
    echo '</form>';
    echo '</br>';
    echo '<form method="post" action="#">';
    echo '    <fieldset><legend></legend><input type ="hidden" name="participation" value=1/></fieldset>';
    echo '   <input type ="submit" name="submit" value="Participer"/>';
    echo '</form>';
  


