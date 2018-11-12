<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.css">
        <link rel="stylesheet" href="/css/sidebar.css">
        <link rel="stylesheet" href="/css/phatadvisor.css">
        <link rel="stylesheet" href="/css/form.css">
        <link rel="stylesheet" href="/css/restaurants.css">
        <link rel="stylesheet" href="/css/restaurant.css">
        <link rel="stylesheet" href="/css/add-restaurant.css">
        <link rel="stylesheet" href="/css/users.css">
        <link rel="stylesheet" href="/css/caroussel.css">
        <link href="https://fonts.googleapis.com/css?family=Advent+Pro:600,700" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.all.min.js""></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
			  crossorigin="anonymous"></script>
        <script src="/js/session.js"></script>
        <script src="/js/sidebar.js"></script>
    </head>
    <body>
        <div id="header">
            <span id="title" class="col-xs-3">
                <img src="../assets/images/icons_logo/Logo Phat'Advisor.png"/>
                Phat' Advisor
            </span>
        </div>
        <div class="container">
            <div class="col-xs-3">
                <nav class="navbar" id="sidebar-wrapper" role="navigation">
                    <ul id="menu_list" class="nav sidebar-nav">
                        <li id="menu_home">
                            <a href="/"><i class="fas fa-home"></i>Accueil</a>
                        </li>
                        <li id="menu_add_restaurant">               
                            <a href="/restaurants/add"><i class="fas fa-plus-square"></i>Ajouter un restaurant</a>
                        </li>
                        <li id="menu_user">
                            <a id="user_acc" href=""><i class="fas fa-user"></i>Paramètres du compte</a>
                        </li>
                        <li id="menu_users">
                            <a href="/users"><i class="fas fa-users"></i>Liste des utilisateurs</a>
                        </li>
                        <li id="menu_form">
                            <a href="/form"><i class="fas fa-sign-in-alt"></i>Connexion/Inscription</a>
                        </li>
                        <li id="menu_disconnect">
                            <a href="/disconnected"><i class="fas fa-sign-out-alt"></i>Déconnexion</a>
                        </li>
                    </ul>
                     <div class="fas"><p id="user_info"></p></div>
                </nav>
            </div>
            <div class="col-xs-9">
                <div>
                    <?php include('./html/'.$pagePath);?>
                </div>
                <div id="coucou" class="text-center hidden">
                    <img id="coucou-5" src="/assets/images/5.png"/>
                    <img id="coucou-3" src="/assets/images/3.png"/>
                    <img id="coucou-1" src="/assets/images/1.png"/>
                    <img id="coucou-2" src="/assets/images/2.png"/>
                    <img id="coucou-4" src="/assets/images/4.png"/>
                    <img id="coucou-6" src="/assets/images/6.png"/>
                </div>
            </div>
        </div>
    </body>
</html>
