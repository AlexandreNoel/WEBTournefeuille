<?php
require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new Repository\User($connection);

$users = $userRepository->fetchAll();
?>

<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h3><?php echo 'Hello world from Docker! php' . PHP_VERSION; ?></h3>
    <button type="button" onclick="location.href = 'view/connect.php';">connect</button>
    
    <button type="button" onclick="location.href = 'view/register.php';">register</button>

    <table class="table table-bordered table-hover table-striped">
        <thead style="font-weight: bold">
            <td>id</td>
            <td>Firstname</td>
            <td>Lastname</td>
            <td>mail</td>
            <td>admin?</td>
        </thead>
        <?php /** @var \User\User $user */
        foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user->getId() ?></td>
                <td><?php echo $user->getFirstname() ?></td>
                <td><?php echo $user->getLastname() ?></td>
                <td><?php echo $user->getMailAdress() ?></td>
                <td><?php echo $user->isAdmin() ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
