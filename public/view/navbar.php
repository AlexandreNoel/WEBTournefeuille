        <!-- NAVBAR !-->
<nav class="navbar navbar-expand-md navbar-dark fixed-top fixed-nav" id="navbarD">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand" href="index.php"><img id="img-navbar" src="assets/images/logo_sf_blanc.png"></a>

        <!-- BANNIERE ACCUEIL !-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link fixed-nav-text" href="/home.php">Accueil</a>
                </li>
                <li id="Actualités" class="nav-item">
                    <a class="nav-link fixed-nav-text" href="/news.php">Actualités</a>
                </li>
                <li id="Catalogue" class="nav-item">
                    <a class="nav-link fixed-nav-text" href="/catalogue.php">Catalogue</a>
                </li>
                <li id="Sphinx06" class="nav-item">
                    <a class="nav-link fixed-nav-text" href="#"><?php echo $username ?> <i class="far fa-user"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script>
    $(document).ready(function() {
        $('a[href="' + this.location.pathname + '"]').parent().addClass('active');
    });
</script>