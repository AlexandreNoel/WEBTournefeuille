<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicon.ico">
    <title>Le Bar D - Console</title>
    <!-- Ressources -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <!-- Font Awesome JS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <!-- Css -->
    <link rel="stylesheet" href="css/bard_main.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/b-1.5.4/datatables.min.css"/>

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/b-1.5.4/datatables.min.js"></script>
</head>

<body class="main-body">

<!-- CONTENU !-->

<div class="content-container">
    <div class="section-container" style:"display: none;">
        <form action="product.php" method="post">
            <div>
                <label>Product Name</label>
                <input
                    type="text"
                    name="libelle"
                    placeholder="Nom du produit"
                    value=""
                >
            </div>
            <div>
                <label>Prix</label>
                <input
                    type="number"
                    name="prix"
                    value=0
                    step=0.05
                >
            </div>
            <div>
                <label>Reduction</label>
                <input
                    type="number"
                    name="reduction"
                    value=0
                >
            </div>
            <div>
                <label>Stock</label>
                <input
                    type="number"
                    name="quantitestock"
                    value=0
                >
            </div>
            <div>
                <label>Catégorie</label>
                <select name="idcategorie">
                <?php foreach($categories as $categorie):?>
                    <option value=<?php echo $categorie["idcategorie"] ?>>
                        <?php echo $categorie["libelle"] ?>
                    </option>
                <?php endforeach; ?>
                </select>
            </div>
            <input type="submit" value="Ajout">
        </form>
    </div>
    <?php foreach ($productslist as $category => $values):?>
            <label><?php echo $category ?></label>
            <table id="table_products" class="display dataTable">
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Reduction</th>
                <th>Stock</th>
            </tr>
                <?php foreach($values as $product): ?>
                    <?php if (!is_null($product)):?>
                        <tr>
                            <td><?php echo $product->getName()?></td>
                            <td><?php echo $product->getPrice()?></td>
                            <td><?php echo $product->getReduction()?></td>
                            <td><?php echo $product->getQuantity()?></td>
                            <td>
                                <form action="update-product.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $product->getId() ?>">
                                    <button class="submit-button" type="submit"><img src="assets/images/edit.png"></button>
                                </form>
                            </td>
                            <td>
                                <form action="update-product.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $product->getId() ?>">
                                    <button class="submit-button" type="submit"><img src="assets/images/cross.png"></button>
                                </form>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
    <?php endforeach; ?>
</div>
</body>
<script>
$(document).ready( function () {
    $('#table_products').DataTable();
} );
</script>

</html>
