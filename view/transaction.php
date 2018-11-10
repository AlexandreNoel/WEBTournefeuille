<!DOCTYPE html>

<head>
    <!-- HEADER !-->
    <?php require_once(__DIR__ . '/partials/header.php'); ?>
</head>

<body class="main-body">
<!-- NAVBAR !-->
<?php require_once(__DIR__ . '/partials/navbar.php'); ?>

<!-- CONTENU !-->
<div class="content-container">
    <div id="transaction-table" class="container pt-3">
        <div class="card">
            <h5 class="card-header text-center">Liste des transactions</h5>
            <div class="card-body">
                <table class="display" style="text-align:center">
                    <thead>
                    <tr>
                        <th><p>
                            <p>Id Commande</p></th>
                        <th><p>Date</p></th>
                        <th><p>Barmen</p></th>
                        <th><p>Prix Total</p></th>
                        <th><p>Détail</p></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach ($transactions as $transaction): ?>
                        <?php
                        ?>
                        <?php if (!is_null($transaction)): ?>
                            <tr>
                                <td><p><?php echo $transaction->getId() ?></p></td>
                                <td><p><?php echo $transaction->getDate()->format('Y-m-d H:i:s') ?></p></td>
                                <td><p><?php echo $nicknameforid[$transaction->getidBarmen()] ?></p></td>
                                <td><p><?php echo $transaction->GetPrice() . " €" ?></p></td>
                                <td>
                                    <button class="btn btn-danger rounded" id="add-button"
                                            onclick="fetchproductdata(<?php echo $transaction->getId(); ?>)"> Voir le
                                        contenu de la commande
                                    </button>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div id="Products-div" class="container pt-3">
        <div class="card">
            <h5 class="card-header text-center">Détail de la transaction</h5>
            <div class="card-body">

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


                </table>
                <button id="back-button">Retour</button>
            </div>
        </div>
    </div>

</div>
<div class="content-container">
    <div id="transaction-table" class="container pt-3">
        <div class="card">
            <h5 class="card-header text-center">Liste des Creditation</h5>
            <div class="card-body">
                <table class="display" style="text-align:center">
                    <thead>
                    <tr>
                        <th><p>
                            <p>Id Credit</p></th>
                        <th><p>Date</p></th>
                        <th><p>Barmen</p></th>
                        <th><p>Montant</p></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach ($credits as $credit): ?>
                        <?php
                        ?>
                        <?php if (!is_null($transaction)): ?>
                            <tr>
                                <td><p><?php echo $credit['idcredit'] ?></p></td>
                                <td><p><?php echo $credit['date'] ?></p></td>
                                <td><p><?php echo $nicknameforid[$credit['idbarmen']] ?></p></td>
                                <td><p><?php echo $credit['montant'] . " €" ?></p></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    var trHTML = '';

    function fetchproductdata(param1) {

        $.ajax({
            type: 'POST',
            url: 'transaction-detail.php',
            data: "idcommande=" + param1,
            success: function (data) {
                console.log(data);
                data = $.parseJSON(data);
                trHTML = "";
                $.each(data, function (i, o) {
                    trHTML += '<tr><td><p>' + o.idcommande +
                        '</p></td><td><p>' + o.name +
                        '</p></td><td><p>' + o.idproduit +
                        '</p></td><td><p>' + o.price + '€' +
                        '</p></td><td><p>' + o.ammount +
                        '</p></td><td><p>' + o.reduction + '€' +
                        '</p></td><td><p>' + o.total + '€' +
                        '</p></td></tr>';
                });
                $('#mybody').children("tr").remove();
                $('#mybody').append(trHTML);
                $("#transaction-table").hide();
                $("#Products-div").show()
            }
        });
    }

    $(document).ready(function () {
        $("#Products-div").hide();
        $("#add-button").on("click", function () {
            $("#transaction-table").hide();
            $("#Products-div").show()
        });
        $("#back-button").on("click", function () {
            $("#Products-div").hide();
            $("#transaction-table").show()
        });

        $('table.display').DataTable({
            "order": [[0, "desc"]]
        });
        $("#Products-div").hide();

    });

</script>
