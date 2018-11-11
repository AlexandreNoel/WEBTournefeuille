
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
                    <label data-error="wrong" data-success="right" for="password"> <i class="fa fa-user"></i> Mot de passe barmen</label>
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
<script>
    $(document).ready(function() {
        $('#modalBarmen').on('hidden.bs.modal', function () {
            $('#error-modal').empty();
            $('#password').empty();
        });
    });

    //Vérification du barmen AJAX
    function checkBarmen(mdp){
        data = new FormData();
        data.append("serviceCheckBarmen",true);
        data.append("password", mdp);
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

                }
            }
        });
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
</script>