<!--Todo replace with the real add-restaurant-->

<button type="button" onclick="location.href = '/index.php';">homepage</button>
<h1> Add new restaurant : </h1>
<form method="post" action="/add-restaurant.php">
    <?php if (isset($view['errors']['nom_resto']) && $view['errors']['nom_resto']): ?>
        <p><font color="red">
                <?php echo $view['errors']['nom_resto'] ?>
            </font></p>
    <?php endif; ?>

    <label>Restaurant name: <input placeholder="Burger King Evry" type="text" name="nom_resto"/></label><br/>

    <?php if (isset($view['errors']['descr_resto']) && $view['errors']['descr_resto']): ?>
        <p><font color="red">
                <?php echo $view['errors']['descr_resto'] ?>
            </font></p>
    <?php endif; ?>

    <label>Description:</label><br/>
     <textarea placeholder="Chaîne réputée proposant hamburgers à la viande grillée, frites, milk-shakes et petits-déjeuners." name="descr_resto" rows="10" cols="50"></textarea><br/>

    <?php if (isset($view['errors']['addr_resto']) && $view['errors']['addr_resto']): ?>
        <p><font color="red">
                <?php echo $view['errors']['addr_resto'] ?>
            </font></p>
    <?php endif; ?>

    <label>Adresse: <input placeholder="172 Place des Terrasses de l'Agora, 91000 Évry" type="text" name="addr_resto"/></label><br/>

    <?php if (isset($view['errors']['cp_resto']) && $view['errors']['cp_resto']): ?>
        <p><font color="red">
                <?php echo $view['errors']['cp_resto'] ?>
            </font> </p>
    <?php endif; ?>

    <label>Code postal: <input placeholder="91000" type="text" name="cp_resto"/></label><br/>

    <?php if (isset($view['errors']['city_resto']) && $view['errors']['city_resto']): ?>
        <p ><font color="red">
                <?php echo $view['errors']['city_resto'] ?>
            </font></p>
    <?php endif; ?>

    <label>Ville: <input placeholder="Evry" type="text" name="city_resto"/></label><br/>


    <?php if (isset($view['errors']['tel_resto']) && $view['errors']['tel_resto']): ?>
        <p ><font color="red">
                <?php echo $view['errors']['tel_resto'] ?>
            </font></p>
    <?php endif; ?>

    <label>Téléphone: <input placeholder="01 82 93 00 31" type="text" name="tel_resto"/></label><br/>

    <?php if (isset($view['errors']['website_resto']) && $view['errors']['website_resto']): ?>
        <p ><font color="red">
                <?php echo $view['errors']['website_resto'] ?>
            </font></p>
    <?php endif; ?>

    <label>Site web: <input placeholder="https://restaurants.burgerking.fr/evry-2" type="text" name="website_resto"/></label><br/>


    <input onclick="location.href = 'add-restaurant.php';" type="submit" value="Add" />
</form>
