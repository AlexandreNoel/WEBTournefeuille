<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<head>
    <!-- HEADER !-->
    <?php require_once(__DIR__ . '/partials/header.php'); ?>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
</head>

<body class="main-body">

<!-- MODAL !-->
<?php require_once(__DIR__ . '/partials/modalBarmen.php'); ?>

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
                    <div class="col w-100">
                        <form enctype="multipart/form-data" id="form-ajout" class="form-ajout" action="add-news.php" method="post">
                            <div>
                                <label>Couverture</label>
                                <div class="custom-file">
                                    <input type="hidden" id="previousImage" name="previousImage">
                                    <input type="file" name="fileToUpload" class="custom-file-input" id="image-input">
                                    <label id="image-label" class="custom-file-label" for="customFile">Choisissez une image de couverture</label>
                                </div>
                                <img id="previewImage" class="mx-auto d-block img-fluid" style="max-height:350px;"/>
                            </div>
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
                            <input id="submit-form" type="submit"  hidden>
                            <input id="validate-add" type="button" value="Ajouter">
                            <button type="button" id="cancel-button"> BACK </button>
                        </form>
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
                                <td><?php echo $auteurlist[$newsentity->getIdAuteur()]?></td>
                                <td><?php echo $newsentity->getDateCreation()->format("d-m-Y")?></td>
                                <td>
                                    <button class="edit-button"
                                            style="background:none;border:0px;"
                                            onclick="updateNews(<?php echo $newsentity->getId();?>)" >
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
<script>
    $(document).ready(function ()
    {
        //===============================================
        // Gestion des états de la page / des actions
        //===============================================
        $("#add-button").on("click",function(){
            $("#add-button").css("display","none");
            $("#tables").css("display", "none");
            $("#titre-input").val(" ");
            $("#contenu-input").val(" ");
            $("#submit-form").val("Ajouter");
            $("#form-ajout").attr('action','add-news.php');
            $("#form-div").show();
        });

        $("#cancel-button").on("click", function(){
            $('#contenu-input').summernote('reset');
            $("#form-div").css("display", "none");
            $("#add-button").show();
            $("#tables").show();
        });

        $("#validate-add").on("click",function(){
            modalAdmin('validateForm');
        });

        //==============================================================
        // Gestion de l'image de couverture / upload / feedback
        // =============================================================
        $("#image-input").change(function () {
            readURL(this);
            var fieldVal = $(this).val().replace(/\\/g, '/').replace(/.*\//, '');
            if (fieldVal != undefined || fieldVal != "") {
                $("#image-label").text(fieldVal);
            }
        });


        //=======================================
        // Gestion add-on js
        //=======================================

        // Initialisation de la table
        $('#table_news').DataTable({
            "order":[3,'asc']
        });

        // Initialisation de l'éditeur et gestion des upload
        $('#contenu-input').summernote({
                placeholder: 'Editer la page d\'article',
                height: 300,
                callbacks: {
                    onImageUpload: function(files, editor, welEditable) {
                        data = new FormData();
                        data.append("fileToUpload", files[0]);
                        sendFile(data,'editor');
                    }
                }
        });

    });


    //============================
    // FONCTIONS
    //============================

    function updateNews(id)
    {
        data = new FormData();
        data.append("idNews",id);
        $.ajax({
            data: data,
            type: "POST",
            url: "/services.php",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                var response = JSON.parse(data);
                if (response.idannonce) {
                    $("#add-button").css("display","none");
                    $("#tables").css("display", "none");
                    $("#previewImage").attr('src',response.image);
                    $("#previousImage").val(response.image);
                    $("#titre-input").val(response.titre);
                    $("#contenu-input").summernote('code', decodeEntities(response.contenu));
                    $("#idauteur-input").val(response.idauteur);
                    $("#idannonce-input").val(response.idannonce);
                    $("#submit-form").val("Modifier");
                    $("#form-ajout").attr('action','update-news.php');
                    $("#form-div").show();
                }
            }
        });
    }

    function decodeEntities(encodedString) {
        var textArea = document.createElement('textarea');
        textArea.innerHTML = encodedString;
        return textArea.value;
    }

    function readURL(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function validateForm(){
        var password = $('#password').val();
        data = new FormData();
        data.append("serviceCheckBarmen",true);
        data.append("password", password);
        $.ajax({
            data: data,
            type: "POST",
            url: "/services.php",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                var response = JSON.parse(data);
                if (response.status == false){
                    $('#error-modal').text(response.error);
                }
                else{
                    $("#idauteur-input").val(response.barmenId);
                    $("#submit-form").click();
                }
            }
        });
    }

    function sendFile(data,type){
        $.ajax({
            data: data,
            type: "POST",
            url: "/services.php",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                var response = JSON.parse(data);
                if (response.status == false){
                    alert(response.error);
                }
                else{
                    switch (type) {
                        case 'editor':
                            var img = $('<img class="articleImage">');
                            var chemin = "/assets/images/articles/";
                            img.attr('src', chemin + response["fileName"]);
                            $('#contenu-input').summernote("insertNode", img[0]);
                    }

                }
            }
        });
    }

</script>
</body>
</html>
