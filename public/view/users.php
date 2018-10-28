<?php
require '../vendor/autoload.php';
?>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<button type="button" onclick="location.href = '/index.php';">homepage</button>
<h4><?php if (isset($_SESSION['name'])) {
        echo $_SESSION['name'];
    } else {
        echo "not connected";
    } ?></h4>


<table class="table table-bordered table-hover table-striped">
    <thead style="font-weight: bold">
    <td>id</td>
    <td>Firstname</td>
    <td>Lastname</td>
    <td>Promo</td>
    <td>mail</td>
    <td>admin?</td>
    <td>action</td>
    </thead>
    <?php
    /** @var \Entity\User $user */
    foreach ($users as $user) : ?>
        <tr>
            <td><?php echo $user->getId() ?></td>
            <td><?php echo $user->getFirstname() ?></td>
            <td><?php echo $user->getLastname() ?></td>
            <td><?php echo $user->getPromo() ?></td>
            <td><?php echo $user->getMailAdress() ?></td>
            <td><?php echo $user->isAdmin() ?></td>
            <td>
            <? if (isset($_SESSION['isadmin']) && $_SESSION['isadmin']) : ?>
                        <form action="user-updateright.php" method="post">
                            <input type="hidden" name="id_user" value="<?php echo $user->getId() ?>">
                            <input type="submit" value="change right"/>
                        </form>
                        <? endif ?> <td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>