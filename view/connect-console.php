<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicon.ico">
    <title>Le Bar D - Connection console</title>    

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

<body class="background-neutral">
<div class="header white">
     <div class="header-container-left">
         <a class="header-link">
             Accueil
         </a>
     </div>
 </div>

<div class="section">
    <div class="section-header">
        <h3 class="section-header-name">Console Access Login</h3>
    </div>
    <div class="section-container">
        <form action="connect-console.php" method="post">
            <div>
                <label>Login</label>
                <input
                    type="text"
                    name="login"
                    placeholder="login"
                    value="<?php echo $view['user']['login'] ?? null ?>"
                >
            </div>
            <!-- <?php if ($view['errors']['login']): ?>
                <p>
                    <?php echo $view['errors']['login'] ?>
                </p>
            <?php endif; ?> -->
            <div>
                <label>Password</label>
                <input
                    type="text"
                    name="password"
                    placeholder="password"
                    value="<?php echo $view['user']['password'] ?? null ?>"
                >
            </div>
            <!-- <?php if ($view['errors']['password']): ?>
                <p>
                    <?php echo $view['errors']['password'] ?>
                </p>
            <?php endif; ?> -->
            <!-- <?php if ($view['errors']['login-password']): ?>
                <p>
                    <?php echo $view['errors']['login-password'] ?>
                </p>
            <?php endif; ?> -->
            <input type="submit" value="Log in">
        </form>
    </div>
</div>
</body>
</html>