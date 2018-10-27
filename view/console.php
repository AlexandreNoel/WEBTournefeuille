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
</head>

<body class="main-body">
    <!-- NAVBAR !-->
    <?php require_once(__DIR__ . '/partials/navbar.php'); ?>

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

            <article class='searchTab mx-auto text-center'>
                <h2>Recherche du client</h2>
                <form class="searchAC form mt-5" autocomplete="off" action="">
                    <input id="searchInput" name="current-user" type="text" class="form__field" placeholder="Nom du client" />
                    <button id="searchSubmit" type="button" onclick="submitUser()" class="btn btn--primary btn--inside rounded uppercase">Valider</button>
                </form>

            </article>

            <article class='userTab mx-auto text-center '>
                <form class="container">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="user-title-card"></h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4"> <img class="img-fluid" src="assets/images/user_avatar.png" /></div>
                                <div class="col-sm-4">
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
                                        <p>Solde :  </p>
                                    </div>
                                    <div class="row">
                                        <input id="creditInput" name="creditInput" type="number" />
                                    </div>
                                    <div class="row text-center">
                                        <button id="creditBtn" name="creditBtn" class="btn btn--primary btn--inside rounded uppercase" >Créditer</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </article>

            <article class='commandTab mx-auto text-center '>
                <form class="container">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="user-title-card"></h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                        <UL>
                                                <li class="var_nav rounded">
                                                    <div class="link_bg"></div>
                                                    <div class="link_title">
                                                        <div class=icon>
                                                            <i class="fa fa-beer"></i>
                                                        </div>
                                                        <a href="#"><span>Bières</span></a>
                                                    </div>
                                                </li>
                                        </UL>
                                </div>
                                <div class="col-sm-4">

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </article>
        </section>
    </div>

    <!--Script-->
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
            // Focus initiale de la page
            $('#searchInput').focus();

            // Gestion des focus sur click
            $('#profile').on('click',function(e){
                $('#creditInput').focus();
            });
            $('#search').on('click',function(e){
                $('#searchInput').focus();
            });

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

        });

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
                            var dataJson = JSON.parse(data);
                            $('#nickname').val(dataJson['pseudo']);
                            $('#firstname').val(dataJson['prenom']);
                            $('#lastname').val(dataJson['nom']);
                            $('#solde').val(dataJson['solde']);
                            $('.user-title-card').html(dataJson['pseudo']);
                            $('#profile').click();
                        }
                        else{

                        }
                    }
                );
            }
        }






    </script>
</body>

</html>
