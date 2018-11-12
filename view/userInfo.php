<!DOCTYPE html>
<html>

<head>
    <!-- HEADER !-->
    <?php require_once(__DIR__ . '/partials/header.php'); ?>
</head>
<body>
    <!-- NAVBAR !-->
    <?php require_once(__DIR__ . '/partials/navbar.php'); ?>

    <!-- CONTENU !-->
    <div class="content-container">
        <div class="container">
            <div class="card">
                <h5 class="card-header text-center">Mes informations</h5>
                <div class="card-body m-3">
                    <form enctype="multipart/form-data" id="" class="form-ajout" action="userInfo.php" method="post">
                        <div class="row">
                            <div class="col-sm-6">
                                <div>
                                    <label>Image de profil</label>
                                    <div class="custom-file">
                                        <input type="hidden" id="previousImage" name="previousImage">
                                        <input type="file" name="image" class="custom-file-input" id="image-input">
                                        <label id="image-label" class="custom-file-label" for="customFile">Choisissez une image de profil</label>
                                    </div>
                                    <img id="previewImage" class="mx-auto d-block img-fluid" src="<?php echo $user->getImage()?>" style="max-height:350px;"/>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div>
                                    <label>Pseudo*</label>
                                    <input
                                            id="nickname-input"
                                            type="text"
                                            name="pseudo"
                                            placeholder="Pseudo"
                                            value="<?php echo $user->getNickname();?>"
                                            readonly
                                    >
                                    <label>Nom*</label>
                                    <input
                                            id="lastname-input"
                                            type="text"
                                            name="nom"
                                            placeholder="Nom"
                                            value="<?php echo $user->getLastname();?>"
                                            readonly
                                    >
                                    <label>Prénom*</label>
                                    <input
                                            id="firstname-input"
                                            type="text"
                                            name="prenom"
                                            placeholder="Prénom"
                                            value="<?php echo $user->getFirstname();?>"
                                            readonly
                                    >
                                    <label>E-mail</label>
                                    <input
                                            id="email-input"
                                            type="text"
                                            name="email"
                                            placeholder="Mon e-mail"
                                            value="<?php echo $user->getEmail();?>"
                                    >

                                    <input
                                            id="idutilisateur-input"
                                            type="hidden"
                                            name="idutilisateur"
                                            value="<?php echo $user->getId();?>"
                                    >

                                </div>
                                <input id="validate-add" type="submit" value="Modifier mes informations">
                            </div>
                        </div>
                    </form>
                    <span>Pour changer les informations marquées d'un *, veuillez-vous rendre sur Arise.</span>
                </div>
            </div>
        </div>
    </div>


<script>
    var msg = "<?php echo $msg ?>";

    $(document).ready(function(){
       if(msg!= "" && msg!= null){
           alert(msg);
       }
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

    function readURL(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>

</html>
