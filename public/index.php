<?php
require '../vendor/autoload.php';

session_start();

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new Repository\User($connection);
$restoRepository = new Repository\Restaurant($connection);

$users = $userRepository->fetchAll();
$restos = $restoRepository->fetchAll();
?>

<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h3><?php echo 'Hello world from Docker! php' . PHP_VERSION; ?></h3>
    <h4><?php if(isset($_SESSION['name'])){echo $_SESSION['name']; } else { echo "not connected";} ?></h4>
    <button style="<?php if(isset($_SESSION['name'])){echo "display:none";}else{echo "";} ?>" type="button" onclick="location.href = 'view/connect.php';">connect</button>

    <button style="<?php if(isset($_SESSION['name'])){echo "display:none";}else{echo "";} ?>" type="button" onclick="location.href = 'view/register.php';">register</button>
    <button style="<?php if(!isset($_SESSION['name'])){echo "display:none";}else{echo "";} ?>" type="button" onclick="location.href = '/disconnect.php';">disconnect</button>

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


<?php if (isset($_SESSION['name'])) { ?>
<div id="restos">

<button type="button" onclick="location.href = 'view/add-restaurant.php';">add resto</button>

     <table class="table table-bordered table-hover table-striped">
        <thead style="font-weight: bold">
            <td>id</td>
            <td>resto name</td>
            <td>resto descr</td>
            <td>resto addr</td>
            <td>cpp addr</td>
            <td>resto city</td>
            <td>resto tel</td>
            <td>resto website</td>
            <td>isDeleted</td>
        </thead>
        <?php 
        /** @var \User\User $user */
        foreach ($restos as $resto) : ?>
            <tr>
                <td><?php echo $resto->getId() ?></td>
                <td><?php echo $resto->getName() ?></td>
                <td><?php echo $resto->getDescription() ?></td>
                <td><?php echo $resto->getAddress() ?></td>
                <td><?php echo $resto->getZipCode() ?></td>
                <td><?php echo $resto->getCity() ?></td>
                <td><?php echo $resto->getPhoneNumber() ?></td>
                <td><?php echo $resto->getUrl() ?></td>
                <td><?php echo $resto->isDeleted() ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    </div>
 <?php } ?>

</div>
</body>
</html>
