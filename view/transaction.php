
<!DOCTYPE html>

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


<body class="main-body">

<!-- CONTENU !-->
<div>
    <table id="transaction-table" class="display" style="text-align:center">
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

        foreach($transactions as $transaction): ?>
            <?php
            ?>
            <?php if (!is_null($transaction)):?>
                <tr>
                    <td><?php echo $transaction->getId()?></td>
                    <td><?php echo $transaction->getDate()->format('Y-m-d H:i:s')?></td>
                    <td><?php echo $transaction->getidBarmen()?></td>
                    <td><?php echo $transaction->GetPrice()." €"?></td>
                    <td><button id="add-button" onclick="downloadFichier(<?php echo $transaction->getId();?>)"> Voir le contenu de la commande</button>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        </tfoot>
    </table>
</div>

<div id="Products-div">
    <table id="commande-table" class="display" style="text-align:center">
        <thead>
        <tr>
            <th>Id Commande</th>
            <th>Id Produit</th>
            <th>Nom Produit</th>
            <th>Prix Unitaire</th>
            <th>Quantite</th>
            <th>Reduction</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody id="mybody">


        </tfoot>
        <td>

    </table>
            <button id="back-button">Retour</button>
</div>


<script>
    var trHTML = '';

    function downloadFichier(param1) {

        $.ajax({
            type: 'POST',
            url: 'transaction-detail.php',
            data: "idcommande=" + param1,
            success: function (data) {
                console.log(data);
                data=$.parseJSON(data)
                trHTML="";
                $.each(data, function (i, o){
                    trHTML += '<tr><td>' + o.idcommande +
                        '</td><td>' + o.name +
                        '</td><td>' + o.idproduit +
                        '</td><td>' + o.price +
                        '</td><td>' + o.ammount +
                        '</td><td>' + o.reduction +
                        '</td><td>' + o.total +
                        '</td></tr>';
                });
                $('#mybody').children("tr").remove();
                $('#mybody').append(trHTML);
                $("#transaction-table").css("display", "none"),
                    $("#Products-div").show()
            }
        });
    }
    $(document).ready(function () {
        $("#Products-div").css("display", "none");
        $("#add-button").on("click",function() {
        $("#transaction-table").css("display", "none"),
            $("#Products-div").show()
    }); $("#back-button").on("click",function() {
        $("#Products-div").css("display", "none"),
            $("#transaction-table").show()
    });
    $(document).ready(function() {
        $('table.display').DataTable();
        $("#Products-div").css("display", "none");

    } );


});
</script>
