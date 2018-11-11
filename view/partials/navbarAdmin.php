<!-- NAVBAR !-->
<nav class="navbar navbar-expand-md navbar-dark fixed-top fixed-nav" id="navbarD">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand" href="/console"><img id="img-navbar" src="assets/images/logo_sf_blanc.png"></a>

        <!-- BANNIERE ACCUEIL !-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link fixed-nav-text" href="/console">Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link fixed-nav-text dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Gestion du bar <i class="fa fa-cog"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="/gestionProduct">Gestion des produits</a>
                        <a class="dropdown-item" href="/gestionNews">Gestion des news</a>
                        <a class="dropdown-item" href="#">Gestion des utilisateurs</a>
                    </div>
                </li>
                <li id="<?php print $_SESSION['authenticated_admin']['login'] ?>" class="nav-item">
                    <a class="nav-link fixed-nav-text" href="#"><?php print $_SESSION['authenticated_admin']['login'] ?> <i class="far fa-user"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    $(document).ready(function() {
        $('a[href="' + this.location.pathname + '"]').closest("li").addClass('active');
    });
</script>