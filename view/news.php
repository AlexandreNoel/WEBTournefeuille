<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<!-- HEADER !-->
<?php require_once(__DIR__ . '/partials/header.php'); ?>

<body class="main-body">

<!-- NAVBAR !-->
<?php require_once(__DIR__ . '/partials/navbarAdmin.php'); ?>

<!-- CONTENU !-->

<div class="content-container">
    <div class="container">
    <div class="card">
        <h5 class="card-header text-center">Gestion des news</h5>
        <div class="card-body m-3">
            <div id="form-div">
                <div class="row">
                    <div class="col">
                        <form id="form-ajout" class="form-ajout" action="add-news.php" method="post">
                            <div>
                                <label>Titre</label>
                                <input
                                        id="titre-input"
                                        type="text"
                                        name="titre"
                                        placeholder="Titre de la news"
                                        value=""
                                >
                            </div>
                            <div>
                                <label>Contenu</label>
                                <textarea
                                        id="contenu-input"
                                        name="contenu"
                                        title="Contenu"
                                        onkeyup="showHTML()"
                                ></textarea>
                            </div>
                            <input
                                    id="idauteur-input"
                                    type="hidden"
                                    name="idauteur"
                                    value="0"
                            >
                            <input
                                    id="idannonce-input"
                                    type="hidden"
                                    name="idannonce"
                                    value="0"
                            >
                            <input id="submit-form" type="submit" value="Ajouter">
                            <button type="button" id="cancel-button"> BACK </button>
                        </form>
                    </div>
                    <div class="col">
                        <h6>Prévisualisation</h6>
                        <div id="previewNews" class="border" style="min-height:100px;">

                        </div>
                    </div>
                </div>

            </div>
            <div id="add text-left">
                <button class="btn btn-primary rounded" id="add-button">Ajouter une news</button>
            </div>
            <div id="tables">
                <table id="table_news" class="display">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Contenu</th>
                            <th>Auteur</th>
                            <th>Date création</th>
                            <th>Modify</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($news as $newsentity): ?>
                        <?php if (!is_null($newsentity)):?>
                            <tr>
                                <td><?php echo $newsentity->getTitle()?></td>
                                <td><?php echo $newsentity->getContenu()?></td>
                                <td><?php echo $auteurlist[$newsentity->getIdAuteur()]?></td>
                                <td><?php echo $newsentity->getDateCreation()->format("d-m-Y")?></td>
                                <td>
                                    <button class="edit-button" style="background:none;border:0px;" onclick="updateNews(<?php echo "'" . $newsentity->getTitle() . "', '" .
                                     $newsentity->getContenu() . "' ," .
                                     $newsentity->getIdAuteur() . " ," .
                                     $newsentity->getId();?>)" >
                                    <img class="icon" src="assets/images/edit.png">
                                    </button>
                                </td>
                                <td>
                                    <form action="del-news.php" method="post">
                                        <input type="hidden" name="id_annonce" value="<?php echo $newsentity->getId() ?>">
                                        <button class="remove-button" style="background:none;border:0px;">
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
            $("#titre-input").val(" "),
            $("#contenu-input").val(" "),
            $("#idauteur-input").val(<?php echo $_SESSION["authenticated_user"]->getId()?>),
            $("#submit-form").val("Ajouter"),
            $("#form-ajout").attr('action','add-news.php'),
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

    function updateNews(titre, contenu, idauteur, idannonce) {
        $("#add-button").css("display","none"),
        $("#tables").css("display", "none"),
        $("#titre-input").val(titre),
        $("#contenu-input").val(contenu),
        $("#idauteur-input").val(idauteur),
        $("#idannonce-input").val(idannonce),
        $("#submit-form").val("Modifier"),
        $("#form-ajout").attr('action','update-news.php'),
        $("#form-div").show()
    }

    function showHTML(){
        console.log('OK');
        $('#previewNews').html($('#contenu-input').val());
    }
</script>
</html>
