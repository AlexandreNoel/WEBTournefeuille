<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
        <link rel="stylesheet" href="/css/sidebar.css">
        <link rel="stylesheet" href="/css/phatadvisor.css">
        <link rel="stylesheet" href="/css/form.css">
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
            <span class="col-xs-3">Phat' Advisor</span>
        </div>
        <div id="wrapper">
            <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
                <ul class="nav sidebar-nav">
                    <li class="selected">
                        <a href="#"><i class="fas fa-home"></i>Home</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-taxi"></i>Services</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-phone"></i>Contact</a>
                    </li>
                </ul>
            </nav>

            <div class="container">
                <?php include('./html/'.$pagePath);?>
            </div>
    </body>
</html>
