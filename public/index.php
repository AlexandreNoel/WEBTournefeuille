<?php
require '../vendor/autoload.php';
session_start();
include("index_restaurant.php");
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

    <button style="<?php if (!isset($_SESSION['isadmin']) || !$_SESSION['isadmin']) {
                        echo "display:none";
                    } else {
                        echo "";
                    } ?>" type="button" onclick="location.href = '/index_user.php';">user list</button>

    

        <div id="restos">

            <? if (isset($_SESSION['isadmin']) && $_SESSION['isadmin']) :?>
                <button type="button" onclick="location.href = 'view/add-restaurant.php';">add resto</button>
            <? endif?>

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
                        <td>
                            <? if (isset($_SESSION['isadmin']) && $_SESSION['isadmin'] && !$resto->isDeleted()) :?>
                                <form action="delete-restaurant.php" method="post">
                                    <input type="hidden" name="id_resto" value="<?php echo $resto->getId() ?>">
                                    <input type="submit" value="Delete"/>
                                </form>
                            <? endif?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>

</div>
</body>
</html>
