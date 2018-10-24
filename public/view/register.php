<!--Todo replace with the real registerView-->

<button type="button" onclick="location.href = '/index.php';">homepage</button>
<h1> Register here : </h1>
<form method="post" action="/register.php">
<label>First name: <input type="text" name="prenom_user"/></label><br/>
<label>Last name: <input type="text" name="nom_user"/></label><br/>
<label>promotion: <input type="text" name="promo_user"/></label><br/>
<label>Adresse e-mail: <input type="text" name="mail_user"/></label><br/>
<label>Mot de passe: <input type="password" name="secret_user"/></label><br/>
<input onclick="location.href = 'register.php';" type="submit"/>
</form>
