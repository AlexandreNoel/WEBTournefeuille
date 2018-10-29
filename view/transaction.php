
<!DOCTYPE html>

<!-- NAVBAR !-->
<?php require_once(__DIR__ . '/partials/header.php'); ?>


<body class="main-body">
<!-- NAVBAR !-->
<?php require_once(__DIR__ . '/partials/navbar.php'); ?>

<!-- CONTENU !-->
<div  class="content-container">
    <div id="transaction-table" class="container pt-3">
        <div class="card">
            <h5 class="card-header text-center">Liste des transactions</h5>
            <div class="card-body">
                <table class="display" style="text-align:center">
                    <thead>
                    <tr>
                        <th>Id Commande</th>
                        <th>Date</th>
                        <th>Barmen</th>
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
                                <td><?php echo $nicknameforid[$transaction->getidBarmen()]?></td>
                                <td><?php echo $transaction->GetPrice()." €"?></td>
                                <td><button class="btn btn-danger rounded" id="add-button" onclick="fetchproductdata(<?php echo $transaction->getId();?>)"> Voir le contenu de la commande</button>
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


                    </tfoot>
                    <td>

                </table>
                <button id="back-button">Retour</button>
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
                $("#transaction-table").hide();
                $("#Products-div").show()
            }
        });
    }
    $(document).ready(function () {
        $("#Products-div").hide();
        $("#add-button").on("click",function() {
            $("#transaction-table").hide();
            $("#Products-div").show()
        });
        $("#back-button").on("click",function() {
            $("#Products-div").hide();
            $("#transaction-table").show()
        });

        $('table.display').DataTable();
        $("#Products-div").hide();

    });

</script>
