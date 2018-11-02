<!DOCTYPE html>
<html>

<!-- HEADER !-->
<?php require_once(__DIR__ . '/partials/header.php'); ?>

<body class="main-body">

    <!--MODAL-->
    <div class="modal fade" id="modalBarmen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Validation barmen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <input type="password" id="password" name="password" class="form-control validate">
                        <label data-error="wrong" data-success="right" for="defaultForm-email">   <i class="fa fa-user"></i> Mot de passe barmen</label>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button id="action-modal" onclick="" class="btn btn-default" >Confirmer</button>
                </div>
                <div id="error-modal" class="text-red font-weight-bold">

                </div>
            </div>
        </div>
    </div>

    <!-- NAVBAR !-->
    <?php require_once(__DIR__ . '/partials/navbarAdmin.php'); ?>

    <!-- CONTENU !-->

    <div class="content-container">
        <section class="tabConsole">
            <input class="tabConsoleInput" type="radio" id="search" value="1" name="tractor" checked='checked' />
            <input class="tabConsoleInput" type="radio" id="profile" value="2" name="tractor" />
            <input class="tabConsoleInput" type="radio" id="command" value="3" name="tractor" />
            <nav class="mx-auto">
                <label for="search" class='fa fa-search'></label>
                <label for="profile" class='fa fa-user'></label>
                <label for="command" class='fa fa-store'></label>
            </nav>

            <!-- Onglet Recherche utilisateur -->
            <article class='searchTab mx-auto text-center'>
                <h2>Recherche du client</h2>
                <form class="searchAC form mt-5" autocomplete="off" action="">
                    <input id="searchInput" name="current-user" type="text" class="form__field" placeholder="Nom du client" />
                    <button id="searchSubmit" type="button" onclick="submitUser()" class="btn btn--primary btn--inside rounded uppercase">Valider</button>
                </form>

            </article>

            <!-- Onglet gestion utilisateur -->
            <article class='userTab mx-auto text-center '>
                <form class="container" method="POST" action="update-user-solde.php">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="user-title-card"></h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4"> <img class="img-fluid" src="assets/images/user_avatar.png" /></div>
                                <div class="col-sm-4">
                                    <div class="d-none">
                                        <input id="id" name="id" type="text" value="" disabled/>
                                    </div>
                                    <div class="row">
                                        <p>Pseudo:</p>
                                    </div>
                                    <div class="row">
                                        <input id="nickname" name="nickname" type="text" value="" disabled/>
                                    </div>
                                    <div class="row">
                                        <p>Nom:</p>
                                    </div>
                                    <div class="row">
                                        <input id="lastname" name="lastname" type="text" value="" disabled/>
                                    </div>
                                    <div class="row">
                                        <p>Prénom:</p>
                                    </div>
                                    <div class="row">
                                        <input id="firstname" name="firstname" type="text" value=""" disabled/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row">
                                        <p>Solde : </p>
                                    </div>
                                    <div class="row">
                                        <input id="solde" name="solde" type="text" value="" disabled/>
                                    </div>
                                    <div class="row mt-3">
                                        <input id="creditInput" name="creditInput" type="number" />
                                    </div>
                                    <div class="row text-center">
                                        <button type="button" id="creditBtn" name="creditBtn" onclick="modalAdmin('credit')" class="btn btn--primary btn--inside rounded uppercase" >Créditer</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </article>


            <!-- Onglet commande -->
            <article class='commandTab mx-auto text-center '>
                <form class="container">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="user-title-card"></h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Affichage des catégories -->
                                <div id="productsCategories" class="col-sm-4">
                                    <ul>
                                        <?php foreach ($categories as $category){ ?>

                                            <li class="var_nav rounded">
                                                <div class="link_bg"></div>
                                                <div class="link_title">
                                                    <div class=icon>
                                                        <i class="fa fa-beer"></i>
                                                    </div>
                                                    <a id="<?php echo $category['libelle'];?>">
                                                        <span><?php echo $category["libelle"];?></span>
                                                    </a>
                                                </div>
                                            </li>

                                        <?php }?>
                                    </ul>
                                </div>

                                <!-- Affichage des produits -->
                                <div id="productsByCategory" class="productsByCategory col-sm-4">
                                    <!-- Pour chaque catégories de produits-->
                                    <?php foreach ($productslist as $category => $values):?>

                                        <!-- Produits de la catégorie courante-->
                                        <ul id="<?php echo "prod".$category?>">
                                            <?php foreach($values as $product): ?>
                                                <?php if (!is_null($product)):?>
                                                    <li class="var_nav rounded">
                                                        <a class="add-row text-white bold" id="<?php echo "prod-".$product->getId();?>">
                                                            <table class="table align-middle" style="height:100%; width:100%;">
                                                                <tr>
                                                                    <td data="<?php echo $product->getName()?>" class="pName font-weight-bold"><?php echo $product->getName()?></td>
                                                                    <td data="<?php echo $product->getPrice()?>" class="pPrice"><?php echo $product->getPrice()." €";?></td>
                                                                    <td data="<?php echo $product->getQuantity(); ?>" class="pStock">Stock: <?php echo $product->getQuantity(); ?></td>
                                                                </tr>
                                                            </table>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>

                                    <?php endforeach; ?>
                                </div>

                                <!-- Gestion des produits achetés -->
                                <div class="col-sm-4">
                                    <form id="command" >
                                        <div id="futurSolde">
                                            Solde après commande: Na
                                        </div>
                                        <div id="totalAmount">
                                            Montant des achats: 0€
                                        </div>
                                        <button id="command" onclick="modalAdmin('command')" type="button" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalBarmen">Valider</button>
                                        <div class="mt-2">
                                            <table class="table" id="commandTable">
                                                <thead>
                                                    <th></th>
                                                    <th>Produit</th>
                                                    <th>Qté</th>
                                                    <th>€/u</th>
                                                    <th>Total</th>
                                                </thead>
                                                <tbody id="artCommand">

                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </article>

        </section>
    </div>

    <!--Script JS-->
    <script src="assets/js/search.js"></script>
    <script>

        /****************************
         * INITIALISATION DE LA PAGE
         ****************************/

        // Déclaration des utilisateurs disponibles
        var userArray = <?php echo json_encode($usersNickname); ?>;

        // Initiation de l'autocompletion
        autocomplete(document.getElementById("searchInput"),userArray,$('#searchSubmit'));

        $(document).ready(function() {
            //========================
            // INITIALISATION
            //========================
            // Focus initiale de la page
            $('#searchInput').focus();

            $('#productsByCategory ul').hide();


            //========================
            // GESTION DES SHORTCUTS
            //========================
            $(document).on('keypress', function(e) {
                var inputTab = $('input.tabConsoleInput');
                var checkedVal =  $('input.tabConsoleInput:checked').val();
                if (e.which === 119 && e.altKey===true){
                    // Désactivation du focus sur les élements input
                    $('input').blur();
                    // Gestion des onglets
                    inputTab[(checkedVal%inputTab.length)].click();

                    if((checkedVal%inputTab.length) === 0 ){
                        $('#searchInput').focus();
                    }
                    else if((checkedVal%inputTab.length) === 1){
                        $('#creditInput').focus();
                    }
                }
            });

            // Gestion des focus sur click
            $('#profile').on('click',function(e){
                $('#creditInput').focus();
            });
            $('#search').on('click',function(e){;
                $('#searchInput').focus();
            });


            //========================
            // GESTION DES COMMANDES
            //========================
            // Affichage/Masquage des produits sur click catégorie
            $("#productsCategories a").on('click',function (e) {
                var cat = $(e.currentTarget).attr('id');
                var idProd = "prod"+cat;
                var prodList = document.getElementById(idProd);
                if($(prodList).is(":hidden")){
                    $('#productsByCategory ul').hide(750);
                    $(prodList).show(750);
                }
            });

            // Ajout d'un article à la commande
            $(".add-row").click(function(e){
                var commandTable = $('#artCommand');
                var id = $(this).attr('id');
                var idNum =  id.replace('prod-','');
                var product = $(this).find('.pName').attr("data");
                var price = $(this).find('.pPrice').attr("data");
                var stockTr =$(this).find('.pStock');
                var stock = $(stockTr).attr("data");
                var art = commandTable.find("#artCommand-"+id);
                if(stock>0){
                    // Si le produit est présent dans la liste de commande
                    if(art.length>0)   {
                        // Mise à jour de la commande
                        var newqty = parseInt(art.find(".artCommandQty").text())+1;
                        art.find(".artCommandQty").text(newqty);
                        art.find(".artCommandTotal").text(parseFloat(newqty*price).toFixed(2));
                    }
                    // Si le produit n'est pas présent dans la liste de commande
                    else{
                        var tr = "<tr id='artCommand-"+id+"'>"+
                            "<td><button type='button' class='artRemove' onclick='artRemove(this,\""+id+"\")'><i class='fa fa-minus' /></button></td>"+
                            "<td class='artCommandName'>"+ product +"</td>" +
                            "<td class='artCommandQty'>" + 1 + "</td>" +
                            "<td class='artCommandPrice'>" + price + "</td>" +
                            "<td class='artCommandTotal'>" + price + "</td>" +
                            "<td class='artCommandId d-none'>"+idNum+"</td>"+
                        "</tr>";
                        commandTable.append(tr);
                    }

                    // Simulation du coût final
                    calculateAmountTotal();

                    // Simulation du stock final
                    var newStock = parseInt(stock)-1;
                    $(stockTr).text("Stock:"+ newStock);
                    $(stockTr).attr("data",newStock);
                }
            });

            $('#modalBarmen').on('hidden.bs.modal', function () {
                $('#error-modal').empty();
                $('#password').empty();
            });

        });

        function calculateAmountTotal(){
            var montant = 0;
            var solde = Number($('#solde').val());
            // Récupération des articles commandés
            $('#artCommand > tr').each(function() {
                montant= montant + parseFloat($(this).find('.artCommandTotal').text());
            });
            $('#totalAmount').text("Montant commande:" +  parseFloat(montant).toFixed(2) +"€");
            $('#futurSolde').text("Solde après la commande: "+ parseFloat(solde-montant).toFixed(2));
            return montant;
        }


        // Effacement d'une ligne de commande
        function artRemove(productBtn,productId){
            var productStock = $('#productsByCategory').find('#'+productId).find('.pStock');
            var stockQty = $(productStock).attr('data');
            var qtyCommand = $(productBtn).closest("tr").find(".artCommandQty").text();
            var newStock = parseInt(stockQty)+parseInt(qtyCommand);
            $(productStock).text("Stock:"+ newStock);
            $(productStock).attr("data",newStock);
            // Simulation du stock après suppression de ligne
            $(productBtn).closest("tr").remove();

            calculateAmountTotal();
        }

        // Action sur le modal
        function modalAdmin(action){
            // Réinitialisation
            $('#error-modal').text("");
            $('#password').val("");

            // Gestion des actions
            $('#action-modal').attr('onclick',action +"()");
            $('#modalBarmen').modal('show');
        }

        /************************
         * AJAX
         *************************/

        function submitUser(){
            var name = $('#searchInput').val();
            if(userArray.includes(name) === true){
                $.post("services.php",
                    {
                        getUserInfo: name
                    },
                    function(data, status){
                        if(status == 'success'){
                            console.log(data);
                            var dataJson = JSON.parse(data);
                            var currentCommandeAmount = calculateAmountTotal();
                            var futurSolde = Number(dataJson['solde']);
                            $('#nickname').val(dataJson['pseudo']);
                            $('#firstname').val(dataJson['prenom']);
                            $('#lastname').val(dataJson['nom']);
                            $('#solde').val(dataJson['solde']);
                            $('#id').val(dataJson['idutilisateur']);
                            $('.user-title-card').html(dataJson['pseudo']);
                            $('#futurSolde').html("Solde après commande: " + futurSolde);
                            $('#profile').click();                        }
                        else{
                            alert("Veuillez sélectionner un utilisateur connu.");
                        }
                    }
                );
            }
        }

        function credit(){

            // Déclaration des variables
            var idutilisateur = $('#id').val();
            var password = $('#password').val();
            var credit = $('#creditInput').val();

            // Si aucun utilisateur donné
            if(!parseInt(idutilisateur) > 0) {
                $('#error-modal').text("Aucun utilisateur saisie.");
            }
            //Valuer supérieur à 0
            else if(!parseFloat(credit)>0) {
                $('#error-modal').text("La valeur crédité doit être supérieur à 0.");
            }
            else{
                $.post("services.php",
                    {
                        password:password,
                        id: idutilisateur,
                        credit:credit
                    },
                    function(data, status){
                        if(status == 'success'){
                            var response = JSON.parse(data);
                            if (response.status == false){
                                $('#error-modal').text(response.error);
                            }
                            else{
                                var solde = $('#solde').val();
                                var newSolde = parseFloat(Number(credit)+Number(solde)).toFixed(2);
                                $('#solde').val(newSolde);
                                $('#creditInput').val(0);
                                $('#modalBarmen').modal('hide');
                                $('#password').val("");
                                alert("La mise à jour s'est bien effectué");
                            }

                        }
                        else{
                            alert("Mise à jour non validé.");
                        }
                    }
                );
            }
        }

        function command(){

            // Déclaration des variables
            var idutilisateur = $('#id').val();
            var password = $('#password').val();

            // Si aucun utilisateur donné
            if(!parseInt(idutilisateur) > 0) {
                $('#error-modal').text("Aucun utilisateur saisie.");
            }
            // Si aucun article commandé
            else if(!($('#artCommand > tr').length > 0)){
                $('#error-modal').text("Pas de commande en cours.");
            }
            // Création de la commande
            else{
                var products = [];

                // Récupération des articles commandés
                $('#artCommand > tr').each(function() {
                    product={};
                    product['id']=$(this).find('.artCommandId').text();
                    product['name']=$(this).find('.artCommandName').text();
                    product['qty']=$(this).find('.artCommandQty').text();
                    product['total']=$(this).find('.artCommandTotal').text();
                    products.push(product);
                });

                // Appel ajax
                $.post("services.php",
                    {
                        products: products,
                        idutilisateur:idutilisateur,
                        password:password,
                        command: true
                    },
                    function (data, status) {
                        if(status == 'success') {
                            var response = JSON.parse(data);
                            if (response.status == false){
                                $('#error-modal').text(response.error);
                            }
                            else{
                                $('#modalBarmen').modal('hide');
                                $('#password').val("");
                                $("#artCommand").empty();
                                $('#totalAmount').text("Montant commande: 0€");
                                alert("La commande a été validée.");
                            }
                        }
                        else {
                            alert("Mise à jour non validé: une erreur est survenue.");
                        }
                    }
                );
            }
        }

    </script>
</body>

</html>
