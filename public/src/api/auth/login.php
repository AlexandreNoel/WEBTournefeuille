<?php
/**
 * Tente d'authentifier l'utilisateur
 * Méthode : POST
 * Paramètres :
 * - identifier : le nom d'utilisateur ou l'adresse de l'utilisateur
 * - password   : le mot de passe fourni
 * Renvoi :
 * - status = success si l'utilisateur est connecté, avec ses informations.
 * - status = error sinon (mauvais identifiant / mot de passe).
 */

require_once("../../config.php");
require_once("User.php");


if (isset($_POST['identifier']))
    $identifier = $_POST['identifier'];
else
    error_die("Missing POST parameter 'identifier'.");

if (isset($_POST['password']))
    $password = $_POST['password'];
else
    error_die("Missing POST parameter 'password'.");

try
{
    $u = User::findWithUsernameOrEmail($identifier);
}
catch (UserNotFoundException $e)
{
    error_die($e->getMessage());
}

if (User::testPassword($u->getID(), $password))
    authenticate($u);
else
    error_die("Authentication failed: Bad password.");
