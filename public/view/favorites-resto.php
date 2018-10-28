<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <h4><?php if (isset($_SESSION['name'])) {
            echo $_SESSION['name'];
        } else {
            echo "not connected";
        } ?></h4>
        
        <button type="button" onclick="location.href = '/index.php';">homepage</button>

<div id="restos">


        <table class="table table-bordered table-hover table-striped">
            <thead style="font-weight: bold">
            <td>resto name</td>
            <td>resto addr</td>
            <td>resto city</td>
            </thead>
            <?php

            /** @var \User\User $user */
            foreach ($restos as $resto) : ?>
                <tr>
                    <td><?php echo $resto->getName() ?></td>
                    <td><?php echo $resto->getAddress() ?></td>
                    <td><?php echo $resto->getCity() ?></td>
                <tr>
                     <?php endforeach; ?>
                  </table>
</div>
</body>
</html>