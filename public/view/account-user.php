<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<button type="button" onclick="location.href = '/index.php';">homepage</button>
<h4><?php if(isset($_SESSION['name'])){echo $_SESSION['name']; } ?></h4>

<?php if (isset($user)) : ?>
<table class="table table-bordered table-hover table-striped">
    <thead style="font-weight: bold">
    <td>Firstname</td>
    <td>Lastname</td>
    <td>Promo</td>
    <td>Mail</td>
    </thead>

    <tr>
        <td><?php echo $user->getFirstname() ?></td>
        <td><?php echo $user->getLastname() ?></td>
        <td><?php echo $user->getPromo() ?></td>
        <td><?php echo $user->getMailAdress() ?></td>
    </tr>
</table>

<?php endif;?>

</body>
</html>
