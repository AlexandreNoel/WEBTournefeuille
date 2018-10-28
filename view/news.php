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
    <div id="add">
        <button id="add-button">Ajouter une news</button>
    </div>
    <div id="tables">
        <div id="single-table">
                <label id="table-tile">News</label>
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
                                    <button class="edit-button" onclick="updateNews(<?php echo "'" . $newsentity->getTitle() . "', '" .
                                     $newsentity->getContenu() . "' ," .
                                     $newsentity->getIdAuteur() . " ," .
                                     $newsentity->getId();?>)" >
                                    <img class="icon" src="assets/images/edit.png">
                                    </button>
                                </td>
                                <td>
                                    <form action="del-news.php" method="post">
                                        <input type="hidden" name="id_annonce" value="<?php echo $newsentity->getId() ?>">
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
</script>
</html>
