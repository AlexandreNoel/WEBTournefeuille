<?php
namespace Client\Repository;
use \Adapter\DatabaseFactory;

class Client
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $dbFactory = new DatabaseFactory();
        $this->dbAdapter = $dbFactory->getDbAdapter();
        $this->hydrator = new \Client\Hydrator\Client();
    }

    public function fetchAllUsers()
    {
        $statement = $this->dbAdapter->query('SELECT u.*,b.codebarmen FROM Utilisateur u left join barmen b on u.idutilisateur = b.idutilisateur ');
        $users = [];
        foreach ($statement->fetchAll() as $row) {
            $entity = new \Client\Entity\Client();
            $users[] = $this->hydrator->hydrate($row, clone $entity);
        }

        return $users;
    }

    public function findOneById($id)
    {
        $user = null;
        $statement = $this->dbAdapter->prepare(
            'select u.*,b.codebarmen from Utilisateur u left join barmen b on u.idutilisateur = b.idutilisateur where u.idUtilisateur = :id');
        $statement->bindParam(':id', $id);
        $statement->execute();
        foreach ($statement->fetchAll() as $row) {
            $entity = new \Client\Entity\Client();
            $user = $this->hydrator->hydrate($row, clone $entity);
        }
        return $user;
    }

    public function findOneByNickname($nickname)
    {
        $nickname = strtolower($nickname);
        $user = null;
        $statement = $this->dbAdapter->prepare(
            'select u.*,b.codebarmen from Utilisateur u left join barmen b on u.idutilisateur = b.idutilisateur where lower(u.pseudo) = :nickname');
        $statement->bindParam(':nickname', $nickname);
        $statement->execute();
        foreach ($statement->fetchAll() as $row) {
            $entity = new \Client\Entity\Client();
            $user = $this->hydrator->hydrate($row, clone $entity);
        }
        return $user;
    }

    public function giveMoney($id,$money)
    {
        $user = null;
        $statement = $this->dbAdapter->prepare(
            'update  Utilisateur set solde = solde+:money where idutilisateur=:id');
        $statement->bindParam(':id', $id);
        $statement->bindParam(':money', $money);
        $statement->execute();
    }

    public function findByAriseData($lastname, $firstname, $nickname)
    {
        $user = null;

        $statement = $this->dbAdapter->prepare('select u.*,b.codebarmen from Utilisateur u left join barmen b on u.idutilisateur = b.idutilisateur
                                                where lower(u.nom) LIKE lower(:lastname) 
                                                AND lower(u.prenom) LIKE lower(:firstname) 
                                                AND lower(u.pseudo) LIKE lower(:nickname)');
        $statement->bindParam(':lastname', $lastname);
        $statement->bindParam(':firstname', $firstname);
        $statement->bindParam(':nickname', $nickname);
        $statement->execute();
        foreach ($statement->fetchAll() as $row) {
            $entity = new \Client\Entity\Client();
            $user = $this->hydrator->hydrate($row, clone $entity);
        }
        return $user;

    }


    public function create(\Client\Entity\Client $client) :int
    {
        $taskArray = $this->hydrator->extract($client);
        $statement = $this->dbAdapter->prepare("INSERT INTO utilisateur (nom, prenom, pseudo, solde) values(:lastname,:firstname,:nickname,:solde) RETURNING Idutilisateur");
        $solde=0;
        $statement->bindParam(':lastname', $taskArray['nom']);
        $statement->bindParam(':firstname', $taskArray['prenom']);
        $statement->bindParam(':nickname', $taskArray['pseudo']);
        $statement->bindParam(':solde', $solde);
        $statement->execute();
        $id="";
        foreach ($statement->fetchAll() as $productData) {
            $id=$productData['idutilisateur'];
        }
        return $id;

    }
    public function update(\Client\Entity\Client $client)
    {
        $clientkArray = $this->hydrator->extract($client);
        $statement = $this->dbAdapter->prepare('update utilisateur set nom=:lastname, prenom=:firstname, pseudo=:nickname, solde=:solde where Idutilisateur=:id');

        $solde=0;
        $statement->bindParam(':lastname', $clientkArray['nom']);
        $statement->bindParam(':firstname', $clientkArray['prenom']);
        $statement->bindParam(':nickname', $clientkArray['pseudo']);
        $statement->bindParam(':solde', $clientkArray['solde']);
        $statement->bindParam(':id', $clientkArray['idutilisateur']);
        $statement->execute();


    }
    public function remove(\Client\Entity\Client $client)
    {
        $taskArray = $this->hydrator->extract($client);
        $statement = $this->dbAdapter->prepare("DELETE from utilisateur where idutilisateur=:id ");
        $statement->bindParam(':id', $taskArray['idutilisateur']);
        $statement->execute();

    }

    public function grantBarmen(\Client\Entity\Client $client)
    {
        $clientarray = $this->hydrator->extract($client);
        $statement = $this->dbAdapter->prepare('INSERT INTO Barmen(idutilisateur,codebarmen) values (:id,:codebarmen)');
        $statement->bindParam(':id', $clientarray['idutilisateur']);
        $statement->bindParam(':codebarmen', $clientarray['codebarmen']);
        $statement->execute();


    }
    public function revokeBarmen(\Client\Entity\Client $client)
    {
        $clientarray = $this->hydrator->extract($client);
        $statement = $this->dbAdapter->prepare('delete from barmen where idutilisateur=:id');
        $statement->bindParam(':id', $clientarray['idutilisateur']);
        $statement->execute();


    }
}