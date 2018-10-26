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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" href="css/bard_main.css">
    <link rel="stylesheet" href="css/form-style.css">
</head>

<body class="main-body">

<!-- CONTENU !-->

<div class="content-container">
    <div id="form-div">
        <form class="form-product" action="add-product.php" method="post">
            <div>
                <label>Product Name</label>
                <input
                    id="name-input"
                    type="text"
                    name="libelle"
                    placeholder="Nom du produit"
                    value=""
                >
            </div>
            <div>
                <label>Prix</label>
                <input
                    id="prix-input"
                    type="number"
                    name="prix"
                    value=0
                    step=0.05
                >
            </div>
            <div>
                <label>Reduction</label>
                <input
                    id="reduction-input"
                    type="number"
                    name="reduction"
                    value=0
                >
            </div>
            <div>
                <label>Stock</label>
                <input
                    id="stock-input"
                    type="number"
                    name="quantitestock"
                    value=0
                >
            </div>
            <input
                id="id-input"
                type="hidden"
                name="id"
                value="0"
            >
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
            <input id="submit-form" type="submit" value="Ajouter">
            <button type="button" id="cancel-button"> BACK </button>
        </form>
    </div>
    <span>
          <button id="add-button">Ajout nouveau produit</button>
    </span>
    <div id="products-tables">
    <?php foreach ($productslist as $category => $values):?>
            <div id="single-table">
            <label id="table-tile"><?php echo $category ?></label>
            <table id="table_products" class="display">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Reduction</th>
                        <th>Stock</th>
                        <th>Modify</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($values as $product): ?>
                    <?php if (!is_null($product)):?>
                        <tr>
                            <td><?php echo $product->getName()?></td>
                            <td><?php echo $product->getPrice()?></td>
                            <td><?php echo $product->getReduction()?></td>
                            <td><?php echo $product->getQuantity()?></td>
                            <td>
                                <button class="edit-button" onclick="updateProduct(<?php echo "'" . $product->getName() . "'," .
                                                                                            $product->getPrice() . "," .
                                                                                            $product->getReduction() . "," .
                                                                                            $product->getQuantity() . "," .
                                                                                            $product->getId()  . "," .
                                                                                            $product->getIdfamilly();?>)" >
                                    <img src="assets/images/edit.png">
                                </button>
                            </td>
                            <td>
                                <form action="del-product.php" method="post">
                                    <input type="hidden" name="id_product" value="<?php echo $product->getId() ?>">
                                    <button class="remove-button">
                                        <img src="assets/images/cross.png">
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
            </div>
    <?php endforeach; ?>
    </div>
</div>
</body>
<script>
    $(document).ready(function () {
        $("#add-button").on("click",function(){
            $("#add-button").css("display","none"),
            $("#products-tables").css("display", "none"),
            $("#name-input").val(" "),
            $("#prix-input").val(0),
            $("#reduction-input").val(0),
            $("#stock-input").val(0),
            $("#idcategorie").val(1),
            $("#submit-form").val("Ajouter"),
            $("#form-product").attr('action','add-product.php'),
            $("#form-div").show()
        });

        $("#cancel-button").on("click", function(){
            $("#form-div").css("display", "none"),
            $("#add-button").show(),
            $("#products-tables").show()
        });

        $(document).ready(function() {
            $('table.display').DataTable();
        } );
    });

    function updateProduct(libelle, price, reduction, quantitestock, id, categorie) {
        $("#add-button").css("display","none"),
        $("#products-tables").css("display", "none"),
        $("#name-input").val(libelle),
        $("#prix-input").val(price),
        $("#reduction-input").val(reduction),
        $("#stock-input").val(quantitestock),
        $("#id-input").val(id),
        $("#idcategorie").val(categorie),
        $("#submit-form").val("Modifier"),
        $("#form-product").attr('action','update-produit.php'),
        $("#form-div").show()
    }
</script>
</html>
