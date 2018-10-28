
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicon.ico">
    <title>Le Bar D - Console</title>
    <!-- Ressources -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <!-- Font Awesome JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" href="css/bard_main.css">
    <link rel="stylesheet" href="css/form-style.css">
</head>
<script>$(document).ready(function() {
        $('#example').DataTable();
    } );</script>

<body class="main-body">

<!-- CONTENU !-->
<table id="example" class="display" style="width:100%">
    <thead>
    <tr>
        <th>Id Commande</th>
        <th>Date</th>
        <th>Id Barmen</th>
        <th>Prix Total</th>
        <th>Détail</th>
    </tr>
    </thead>
    <tbody>
    <?php
    echo '<script>console.log($transactions)</script>';

    foreach($transactions as $transaction): ?>
        <?php
        ?>
        <?php if (!is_null($transaction)):?>
            <tr>
                <td><?php echo $transaction->getId()?></td>
                <td><?php echo $transaction->getDate()->format('Y-m-d H:i:s')?></td>
                <td><?php echo $transaction->getidBarmen()?></td>
                <td><?php echo $transaction->GetPrice()." €"?></td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
    </tfoot>
</table>