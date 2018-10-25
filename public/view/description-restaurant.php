<?php
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
                <td>resto name</td>
                <td>resto descr</td>
                <td>resto addr</td>
                <td>cpp addr</td>
                <td>resto city</td>
                <td>resto tel</td>
                <td>resto website</td>
                </thead>

                    <tr>
                        <td><?php echo $resto->getId() ?></td>
                        <td><?php echo $resto->getName() ?></td>
                        <td><?php echo $resto->getDescription() ?></td>
                        <td><?php echo $resto->getAddress() ?></td>
                        <td><?php echo $resto->getZipCode() ?></td>
                        <td><?php echo $resto->getCity() ?></td>
                        <td><?php echo $resto->getPhoneNumber() ?></td>
                        <td><?php echo $resto->getUrl() ?></td>
                
                
                    </tr>
            </table>

</body>
</html>
