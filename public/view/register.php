<!--Todo replace with the real registerView-->

<button type="button" onclick="location.href = '/index.php';">homepage</button>
<h1> Register here : </h1>
<form method="post" action="/register.php">
<label>First name: <input placeholder="John" type="text" name="prenom_user"/></label><br/>

 <?php if (isset($view['errors']['prenom_user']) && $view['errors']['prenom_user']): ?>
                <p><font color="red">
                    <?php echo $view['errors']['prenom_user'] ?>
                </font></p>
            <?php endif; ?>

<label>Last name: <input placeholder="smith" type="text" name="nom_user"/></label><br/>

<?php if (isset($view['errors']['nom_user']) && $view['errors']['nom_user']): ?>
                <p><font color="red">
                    <?php echo $view['errors']['nom_user'] ?>
                </font></p>
            <?php endif; ?>

<label>promotion: <input placeholder="2018" type="text" name="promo_user"/></label><br/>

<?php if (isset($view['errors']['promo_user']) && $view['errors']['promo_user']): ?>
                <p><font color="red">
                    <?php echo $view['errors']['promo_user'] ?>
                </font></p>
            <?php endif; ?>

<label>Adresse e-mail: <input placeholder="john.smith@gmail.com" type="text" name="mail_user"/></label><br/>

<?php if (isset($view['errors']['mail_user']) && $view['errors']['mail_user']): ?>
                <p><font color="red">
                    <?php echo $view['errors']['mail_user'] ?>
               </font> </p>
            <?php endif; ?>

<label>Mot de passe: <input placeholder="********" type="password" name="secret_user"/></label><br/>

<?php if (isset($view['errors']['secret_user']) && $view['errors']['secret_user']): ?>
                <p ><font color="red">
                    <?php echo $view['errors']['secret_user'] ?>
                </font></p>
            <?php endif; ?>
            
<input onclick="location.href = 'register.php';" type="submit"/>
</form>
