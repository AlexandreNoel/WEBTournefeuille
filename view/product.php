<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<!-- NAVBAR !-->
<?php require_once(__DIR__ . '/partials/header.php'); ?>

<body class="main-body">

<!-- NAVBAR !-->
<?php require_once(__DIR__ . '/partials/navbarAdmin.php'); ?>



<!-- CONTENU !-->
<div class="content-container">

    <div class="card">
        <h5 class="card-header text-center">Liste des catégories/produits</h5>
        <div class="card-body">
            <div id="form-div">
                <form id="form-ajout" class="form-ajout" action="add-product.php" method="post">
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
                            min=O
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
                            min=O
                        >
                    </div>
                    <div>
                        <label>Stock</label>
                        <input
                            id="stock-input"
                            type="number"
                            name="quantitestock"
                            value=0
                            min=O
                        >
                    </div>
                    <input
                        id="id-input"
                        type="hidden"
                        name="idproduit"
                        value="0"
                    >
                    <div>
                        <label>Catégorie</label>
                        <select name="idcategorie" id="idcategorie">
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
            <div id="add">
                  <button id="add-button" class="btn btn-primary rounded">Ajout nouveau produit</button>
            </div>
            <div id="tables">
                <div class="container text-center">
            <?php foreach ($productslist as $category => $values):?>

                <div id="single-table" class="row">
                    <label id="table-tile"><?php echo $category ?></label>
                    <table id="table_products" class="display">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prix</th>
                                <th>Reduction</th>
                                <th>Stock</th>
                                <th>Quick modify</th>
                                <th>Modify</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($values as $product): ?>
                            <?php if (!is_null($product)):?>
                                <tr id="tr-<?php echo $product->getId() ?>">
                                    <td><?php echo $product->getName()?></td>
                                    <td><?php echo $product->getPrice()?></td>
                                    <td><?php echo $product->getReduction()?></td>
                                    <td id="stock"><?php echo $product->getQuantity()?></td>
                                    <td>
                                        <button class="quick-edit-buton" onclick="updateStock(<?php echo $product->getId()?>)">
                                            <img class="icon" src="assets/images/quantity.png"
                                        </button>
                                    </td>
                                    <td>
                                        <button class="edit-button" onclick="updateProduct(<?php echo "'" . $product->getName() . "'," .
                                                                                                    $product->getPrice() . "," .
                                                                                                    $product->getReduction() . "," .
                                                                                                    $product->getQuantity() . "," .
                                                                                                    $product->getId()  . "," .
                                                                                                    $product->getIdfamilly();?>)" >
                                            <img class="icon" src="assets/images/edit.png">
                                        </button>
                                    </td>
                                    <td>
                                        <form action="del-product.php" method="post">
                                            <input type="hidden" name="id_product" value="<?php echo $product->getId() ?>">
                                            <button class="remove-button">
                                                <img class="icon" src="assets/images/cross.png">
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
        </div>
    </div>
</div>
</body>
<script>
    $(document).ready(function () {
        $("#add-button").on("click",function(){
            $("#add-button").css("display","none"),
            $("#tables").css("display", "none"),
            $("#name-input").val(" "),
            $("#prix-input").val(0),
            $("#reduction-input").val(0),
            $("#stock-input").val(0),
            $("#idcategorie").val(1),
            $("#submit-form").val("Ajouter"),
            $("#form-ajout").attr('action','add-product.php'),
            $("#form-div").show()
        });

        $("#cancel-button").on("click", function(){
            $("#form-div").css("display", "none"),
            $("#add-button").show(),
            $("#tables").show()
        });

        $(document).ready(function() {
            $('table.display').DataTable();
        } );
    });

    function updateStock(id) {
        var ajout = parseInt(prompt("Quantité à ajouter"));

        if (!isNaN(ajout)){
            $.ajax({
                url : 'stock-product.php',
                type : 'post',
                data : 'quantitestock=' + ajout + '&idproduit=' + id,
                success : function (results) {
                    if (!isNaN(results)){
                        $("#tr-".concat(id)).find("#stock").html(results);
                    } else {
                        console.log(results);
                    }
                }
            });
        }
    }

    function updateProduct(libelle, price, reduction, quantitestock, id, categorie) {
        $("#add-button").css("display","none"),
        $("#tables").css("display", "none"),
        $("#name-input").val(libelle),
        $("#prix-input").val(price),
        $("#reduction-input").val(reduction),
        $("#stock-input").val(quantitestock),
        $("#id-input").val(id),
        $("#idcategorie").val(categorie),
        $("#submit-form").val("Modifier"),
        $("#form-ajout").attr('action','update-product.php'),
        $("#form-div").show()
    }
</script>
</html>
