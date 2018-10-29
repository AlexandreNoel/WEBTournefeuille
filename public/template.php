<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
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
        <script src="/js/sidebar.js"></script>
    </head>
    <body>
        <div id="header" class="row">
            <div class="col-xs-1">
                <button type="button" class="hamburger" data-toggle="offcanvas">
                    <span class="hamb-top"></span>
                    <span class="hamb-middle"></span>
                    <span class="hamb-bottom"></span>
                </button>
            </div>
            <span id="title" class="col-xs-3">Phat' Advisor</span>
        </div>
        <div id="wrapper">
            <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
                <ul class="nav sidebar-nav">
                    <li class="selected">
                        <a href="/"><i class="fas fa-home"></i>Accueil</a>
                    </li>
                    <li>               
                        <a href="/restaurants/add"><i class="fas fa-plus-square"></i>Ajouter un restaurant</a>
                    </li>
                    <li>
                        <a href="/users/1"><i class="fas fa-user"></i>Paramètres du compte</a>
                    </li>
                    <li>
                        <a href="/users"><i class="fas fa-users"></i>Liste des utilisateurs</a>
                    </li>
                                        <li>
                        <a href="/form"><i class="fas fa-sign-in-alt"></i>Connexion/Inscription</a>
                    </li>
                    <li>
                        <a href="/disconnected"><i class="fas fa-sign-out-alt"></i>Déconnexion</a>
                    </li>
                </ul>
            </nav>
            <div class="container">
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
    </body>
    <script src="/js/main.js"></script>
</html>
