<?php

if (!defined('__ROOT__')) define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/config.php');
require_once(__ROOT__ . '/classes/Post.php');

class User implements JsonSerializable
{
    private $ID;
    private $username;
    private $email;
    private $isModerator;

    /**
     * Renvoie l'ID de l'utilisateur.
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * Renvoie le nom d'utilisateur d'un utilisateur.
     */
    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getModerator()
    {
        return $this->isModerator;
    }

    /**
     * Définit la propriété isModerator d'un utilisateur.
     */
    public function setModerator($newModerator)
    {
        $this->isModerator = $newModerator;
    }

    /**
     * Obtient le hash du mot de passe de l'utilisateur (stocké en BDD).
     */
    public function getHash()
    {
        $db = connect();
        $SQL = "SELECT Password FROM " . TABLE_User . " WHERE ID = :id";
        $statement = $db->prepare($SQL);
        $statement->bindValue(":id", $this->getID());
        $statement->execute();
        $row = $statement->fetch();

        return $row["password"];
    }

    function __construct($ID, $username, $email)
    {
        $this->ID = $ID;
        $this->username = $username;
        $this->email = $email;
    }

    /**
     * Initialisation d'un utilisateur à partir d'une ligne de BDD.
     */
    static function fromRow($row)
    {
        $u = new User($row["id"], $row["username"], $row["email"]);
        $u->setModerator($row["moderator"] == "false" ? false : true);

        return $u;
    }

    /**
     * Initialisation d'un utilisateur à partir d'un ID fourni.
     * @throws UserNotFoundException, si l'ID n'existe pas.
     * @param string $ID à partir duquel trouver l'utilisateur
     * @return User L'instance de User correspondant à $ID fourni.
     */
    static function fromID($ID)
    {
        $db = connect();
        $SQL = "SELECT * FROM " . TABLE_User . " WHERE ID = :id";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $ID);
        $statement->execute();
        $row = $statement->fetch();

        if (!$row)
            throw new UserNotFoundException(UserNotFoundException::Given_ID, $ID);

        return User::fromRow($row);
    }

    /**
     * @param $email
     * @return User
     * @throws UserNotFoundException
     */
    static function fromEmail($email)
    {
        $db = connect();
        $SQL = "SELECT * FROM " . TABLE_User . " WHERE Email = :email";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":email", $email);
        $statement->execute();
        $row = $statement->fetch();

        if (!$row)
            throw new UserNotFoundException(UserNotFoundException::Given_Email, $email);

        return User::fromRow($row);
    }

    /**
     * @param $username
     * @return User
     * @throws UserNotFoundException
     */
    static function fromUsername($username)
    {
        $db = connect();
        $SQL = "SELECT * FROM " . TABLE_User . " WHERE Username = :username";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":username", $username);
        $statement->execute();
        $row = $statement->fetch();

        if (!$row)
            throw new UserNotFoundException(UserNotFoundException::Given_Username, $username);

        return User::fromRow($row);
    }

    /**
     * @param $identifier
     * @return User
     * @throws UserNotFoundException
     * Trouve un utilisateur dont l'email ou le nom d'utilisateur est $identifier
     */
    static function findWithUsernameOrEmail($identifier)
    {
        if (User::usernameExists($identifier))
            return User::fromUsername($identifier);
        elseif (User::emailExists($identifier))
            return User::fromEmail($identifier);

        throw new UserNotFoundException(UserNotFoundException::Given_UsernameOrEmail, $identifier);
    }

    /**
     * @param $data
     * @return User
     * @throws UserNotFoundException
     * Trouve un utilisateur dont l'ID ou le nom d'utilisateur est $data
     */
    static function findWithIDorUsername($data)
    {
        try
        {
            $u = User::fromID($data);
            return $u;
        }
        catch (UserNotFoundException $e)
        {
            // On va essayer avec le nom d'utilisateur
        }

        try
        {
            $u = User::fromUsername($data);
            return $u;
        }
        catch (UserNotFoundException $e)
        {
            throw $e;
        }
    }

    /**
     * @param $email
     * @return bool
     * Vérifie si un email est présent dans la base de données.
     */
    static function emailExists($email)
    {
        $db = connect();
        $SQL = "SELECT ID FROM Users WHERE Email = :email";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":email", $email);
        $statement->execute();
        $row = $statement->fetch();

        if (!$row)
            return false;
        else
            return true;
    }

    /**
     * @param $username
     * @return bool
     * Vérifie si un nom d'utilisateur est présent dans la base de données.
     */
    static function usernameExists($username)
    {
        $db = connect();
        $SQL = "SELECT ID FROM Users WHERE Username = :username";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":username", $username);
        $statement->execute();
        $row = $statement->fetch();

        if (!$row)
            return false;
        else
            return true;
    }

    /**
     * @param $id
     * @return bool
     * Vérifie si un ID est présent dans la base de données.
     */
    static function idExists($id)
    {
        $db = connect();
        $SQL = "SELECT ID FROM Users WHERE ID = :id";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $row = $statement->fetch();

        if (!$row)
            return false;
        else
            return true;

    }

    /**
     * Création d'un utilisateur à partir des paramètres qu'il fournit : nom d'utilisateur, e-mail et mot de passe.
     * @param $username
     * @param $email
     * @param $password
     * @return User
     * @throws UserExistsException si l'utilisateur existe déjà (email ou nom d'utilisateur).
     */
    static function create($username, $email, $password)
    {
        if (User::emailExists($email))
            throw new UserExistsException(UserExistsException::Duplicate_Email, $email);
        else if (User::usernameExists($username))
            throw new UserExistsException(UserExistsException::Duplicate_Username, $username);

        $hash = User::hash($password);
        $id = uniqid();

        $db = connect();
        $SQL = "INSERT INTO " . TABLE_User . " (ID, Username, Email, Password, Moderator) VALUES (:id, :username, :email, :password, false)";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $id);
        $statement->bindParam(":username", $username);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $hash);
        $statement->execute();

        $u = new User($id, $username, $email);
        $u->setModerator(false);

        return $u;
    }

    /**
     * Détermine si le mot de passe fourni pour l'utilisateur d'ID $ID est correct.
     * @param $ID
     * @param $attempt
     * @return bool
     * @throws UserNotFoundException si l'ID n'existe pas
     */
    static function testPassword($ID, $attempt)
    {
        if (!self::idExists($ID))
            throw new UserNotFoundException(UserNotFoundException::Given_ID, $ID);

        $db = connect();
        $SQL = "SELECT Password FROM Users WHERE ID = :id";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $ID);
        $statement->execute();

        $row = $statement->fetch();
        $hash = $row["password"];

        return password_verify($attempt, $hash);
    }

    /**
     * Renvoie les publications de l'utilisateur.
     * @param int $limit le nombre maximum de publications à renvoyer
     * @return array un tableau de Post
     */
    function findPosts($limit = 50)
    {
        $db = connect();
        $SQL = "SELECT * FROM " . TABLE_Posts . " WHERE Author = :id ORDER BY Timestamp DESC LIMIT $limit";
        $statement = $db->prepare($SQL);
        $statement->bindValue(":id", $this->ID);
        $statement->execute();
        $rows = $statement->fetchall();

        $posts = array();
        foreach($rows as $row)
            array_push($posts, Post::fromRow($row));
 
        return $posts;
    }

    /**
     * Met à jour le profil de l'utilisateur.
     * @param string $newEmail
     * @param string $newUsername
     * @param string $newPassword
     * @return bool
     * @throws Exception
     */
    function update($newEmail, $newUsername, $newPassword)
    {
        // On vérifie que le nouveau nom d'utilisateur n'est pas déjà pris
        if ($newUsername == null)
            $newUsername = $this->getUsername();
        else {
            try {
                $u = User::fromUsername($newUsername);
                if ($u->getID() != $this->getID())
                    throw new UserExistsException(UserExistsException::Duplicate_Username, $newUsername);
            } catch (UserNotFoundException $e) {

            }
        }

        // On vérifie que la nouvelle adresse e-mail n'est pas déjà enregistrée
        if ($newEmail == null)
            $newEmail = $this->getEmail();
        else {
            try
            {
                $u = User::fromEmail($newEmail);
                if ($u->getID() != $this->getID())
                    throw new UserExistsException(UserExistsException::Duplicate_Email, $newEmail);
            }
            catch (UserNotFoundException $e)
            {

            }
        }

        // On met à jour les infos dans l'instance
        $this->email = $newEmail;
        $this->username = $newUsername;

        // On se connecte à la BDD
        $db = connect();

        $SQL = "UPDATE " . TABLE_User . " SET Email = :email, Username = :username WHERE ID = :id";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":email", $newEmail);
        $statement->bindParam(":username", $newUsername);
        $statement->bindValue(":id", $this->getID());
        $statement->execute();

        if ($newPassword != null) {
            $SQL = "UPDATE " . TABLE_User . " SET Password = :hash WHERE ID = :id";
            $statement = $db->prepare($SQL);
            $statement->bindValue(":hash", User::hash($newPassword));
            $statement->bindValue(":id", $this->getID());
            $statement->execute();
        }

        if ($statement->rowCount() == 1)
            return true;
        else
            return false;
    }

    /**
     * Supprime l'utilisateur.
     * @return bool
     */
    function delete()
    {
        $db = connect();
        
        $SQL = "DELETE FROM Users WHERE ID = :id";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $this->id);
        $statement->execute();

        if ($statement->rowCount() == 1)
            return true;
        else
            return false;
    }

    /**
     * Calcul le hash d'un mot de passe.
     * @param string $password
     * @return string
     */
    public static function hash($password)
    {
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
    }

    /**
     * Sérialise un User.
     * @return array|mixed
     */
    function jsonSerialize()
    {
        $arr = array("username" => $this->username,
            "id" => $this->ID,
            "isModerator" => $this->isModerator);

        return $arr;
    }
}

/**
 * Exception levée lorsqu'un utilisateur qu'on essaie de crééer (via fromID par exemple) n'est pas trouvé.
 * Class UserNotFoundException
 */
class UserNotFoundException extends Exception
{
    const Given_ID = 'ID';
    const Given_Username = 'Username';
    const Given_Email = 'Email';
    const Given_UsernameOrEmail = 'Username or Email';

    protected $given;
    protected $givenValue;

    public function __construct($given, $givenValue, $code = 0, Exception $previous = null) {
        $message = "Can't find user with $given = $givenValue";
        $this->given = $given;
        $this->givenValue = $givenValue;

        parent::__construct($message, $code, $previous);
    }
}

class UserExistsException extends Exception
{
    const Duplicate_Email = 'Email';
    const Duplicate_Username = 'Username';

    protected $duplicate;
    protected $duplicateValue;

    public function __construct($duplicate, $duplicateValue, $code = 0, Exception $previous = null)
    {
        $message = "The $duplicate '$duplicateValue' is already registered.";
        $this->duplicate = $duplicate;
        $this->duplicateValue = $duplicateValue;

        parent::__construct($message, $code, $previous);
    }
}