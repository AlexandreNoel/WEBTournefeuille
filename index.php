<?php
session_start();
include("includes/id.php");
include("includes/debut.php");?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" type="text/css" href="css/template.css">
    <meta charset="UTF-8">
    <title>Page d'acceuil</title>
</head>
<body>
<h1 id="title">
    <a href="index.php"><img class="home" src="img/logo.png" alt="Logo" height ="88" width="94"></a>
    <span id="title1">GolrIIE</span>
    <a href="index.php"><img class="dc" src="img/logo.png" alt="Logo" height ="88" width="94"></a>
</h1>

<?php if ($id!=0) include("menuderoulant.php"); ?>
</body>
</html>