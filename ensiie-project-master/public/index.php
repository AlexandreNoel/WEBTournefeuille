<?php
//require 'sendMail/sendMail.php';
?>
<!DOCTYPE html>
<html>
<head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
<script type="text/javascript" src="../js/controllers/consumed.js"></script>  
<script src="../js/controllers/lookInFridge.js"></script>
<script src="../js/controllers/addFood.js"></script>
<script src="../js/controllers/seeMySpent.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="  crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="../libs/sammy/sammy-latest.min.js"></script>
<script src="../js/controllers/authentification.js"></script>
<link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Frijole" rel="stylesheet">
<script src="../js/controllers/inscription.js"></script>
<script src="../js/CheckFonctions/checkFonctions.js"><script>
<script src="../libs/sammy/sammy-latest.min.js"></script>
<script src="../js/Routes/routes.js"></script>
<link rel="stylesheet" type="text/css" href="../user/css/adminPage.css"/>
<title>Smart Fridge</title>
</head>
<body> 

	<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<nav class="navbar navbar-light bg-light">

    <img src="../views/accueil/navbar.jpg" width="90" height="40" class="d-inline-block align-top" alt="">
  </a>
</nav>
<h1 class="page-header" id="bonjour"> </h1>
<h2 class="page-header" id="iduser"> </h2>
<div id="body">
<form>
  <div class="form-row">
    <div class="col-md-4 mb-2" id="mail1">
      <label for="validationServer01">Mail</label>
      <input type="text" id="mail" class="form-control is-valid" required>
    </div>
    <div class="col-md-4 mb-2" id="pass">
      <label for="inputPassword5">Password</label>
      <input type="password" id="password" class="form-control"  required>
    </div>
</div>
</form>
<button class="btn btn-primary" id="submitB">Connection</button>
<a href="#/inscription" class="btn btn-primary" id="inscription">Inscription</a>
<div id="temp2"></div>
</div>
</body>
</html>
