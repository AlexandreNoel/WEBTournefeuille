<!-- NAVBAR !-->
<nav class="navbar navbar-expand-md navbar-dark fixed-top fixed-nav" id="navbarD">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand" href="/home"><img id="img-navbar" src="assets/images/logo_sf_blanc.png"></a>

        <!-- BANNIERE ACCUEIL !-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="nav-link fixed-nav-text" href="/home">Accueil</a>
                    </li>
                    <li id="Actualités" class="nav-item">
                        <a class="nav-link fixed-nav-text" href="/news">Actualités</a>
                    </li>
                    <li id="Catalogue" class="nav-item">
                        <a class="nav-link fixed-nav-text" href="/catalogue">Catalogue</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link fixed-nav-text dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php print $_SESSION['authenticated_user']->getNickname(); ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/logout.php">Déconnexion</a>
                            <a class="dropdown-item" href="/logout.php?logoutAriseId=true">Déconnexion AriseID</a>
                        </div>
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