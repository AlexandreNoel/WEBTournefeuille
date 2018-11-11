<!doctype html>
<html lang="fr">

<head>
    <!-- HEADER !-->
    <?php require_once(__DIR__ . '/partials/header.php'); ?>
</head>

<body class="main-body">
<div class="header white">
     <div class="header-container-left">
         <button type="button" onclick="location.href = '/';" class="btn rounded header-link">
             <i class="fa fa-home"></i> Accueil
         </button>
     </div>
 </div>

<div id="console-connect-form" class="section">
    <div class="section-header">
        <h3 class="section-header-name text-center">Console Access Login</h3>
        <div class="card"></div><img src="assets/images/admin-barmen.jpg" class="border rounded border-danger" style="max-height:250px;">
    </div>
    <div class="section-container text-center pt-2">
        <form action="connect-console.php" method="post">
            <div class="row text-center">
                <div class="col">
                    <label><i class="fa fa-user"></i>Login</label>
                </div>
                <div class="col">
                    <input
                            type="text"
                            name="login"
                            placeholder="login"
                            value="<?php echo $view['user']['login'] ?? null ?>"
                    >
                </div>
            </div>
            <div class="row text-center">
                <div class="col">
                    <label><i class="fa fa-key"> </i> Password</label>
                </div>
                <div class="col">
                    <input
                            type="password"
                            name="password"
                            placeholder="password"
                            value="<?php echo $view['user']['password'] ?? null ?>"
                    >
                </div>

            </div>
            <input class="mt-5" type="submit" value="Allez log toi, on est bien !">

        </form>
    </div>
</div>
</body>
</html>