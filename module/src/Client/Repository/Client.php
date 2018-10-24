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

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM Utilisateur')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $entity = new User();
            $users[] = $this->hydrator->hydrate($row, clone $entity);
        }

        return $users;
    }

    public function findById($id)
    {
        $user = null;
        $statement = $this->dbAdapter->prepare('select u.*,b.codebarmen from Utilisateur u left join barmen b on u.idutilisateur = b.idutilisateur where u.idUtilisateur = :id');
        $statement->bindParam(':id', $id);
        $statement->execute();
        foreach ($statement->fetchAll() as $row){
            $entity = new \Client\Entity\Client();
            $user = $this->hydrator->hydrate($row, clone $entity);
        }
        return $user;
    }

    public function findByNickname($nickname)
    {
        $users = [];
        $statement = $this->dbAdapter->prepare('select * from Utilisateur where (lower(pseudo) LIKE lower(%:nickname%))');
        $statement->bindParam(':nickname', $nickname);
        $statement->execute();
        foreach ($statement->fetchAll() as $row){
            $entity = new \Client\Entity\Client();
            $users[] = $this->hydrator->hydrate($row, clone $entity);
        }
        return $users;
    }

    public function findByAriseData($lastname,$firstname,$nickname)
    {
        $user = null;

        $statement = $this->dbAdapter->prepare('select * from Utilisateur
                                                where (lower(nom) LIKE lower(%:lastname%)) 
                                                AND (lower(prenom) LIKE lower(%:firstname%)) 
                                                AND (lower(pseudo) LIKE lower(%:nickname%))');
        $statement->bindParam(':lastname', $lastname);
        $statement->bindParam(':firstname', $firstname);
        $statement->bindParam(':nickname', $nickname);
        $statement->execute();

        foreach ($statement->fetchAll() as $row){
            $entity = new \Client\Entity\Client();
            $user = $this->hydrator->hydrate($row, clone $entity);
        }
        return $user;
    }

    public function create(\Client\Entity\Client $client)
    {
        $idrole = 1;
        $solde = 0;
        $taskArray = $this->hydrator->extract($client);
        $statement = $this->dbAdapter->prepare("INSERT INTO utilisateur (idrole,nom, prenom, pseudo, solde) values (:idrole,:lastname, :firstname,:nickname,:solde)");
        $statement->bindParam(':lastname', $taskArray['nom']);
        $statement->bindParam(':firstname', $taskArray['prenom']);
        $statement->bindParam(':nickname', $taskArray['pseudo']);
        $statement->bindParam(':solde', $solde);
        $statement->bindParam(':idrole', $idrole);
    }


    public function createBis(\Client\Entity\Client $product)
    {
        $clientarray = $this->hydrator->extract($product);
        $statement = $this->dbAdapter->prepare('INSERT INTO Utilisateur (idUtilisateur,pseudo,prenom,solde,idRole) values (:idclient, :nickname,:firstname,:lastname,:solde,:idrole)');
        $statement->bindParam(':idclient', $clientarray['idclient']);
        $statement->bindParam(':nickname', $clientarray['nickname']);
        $statement->bindParam(':firstname', $clientarray['firstname']);
        $statement->bindParam(':lastname', $clientarray['lastname']);
        $statement->bindParam(':solde', $clientarray['solde']);
        $statement->bindParam(':idrole', $clientarray['idrole']);
        $statement->execute();
    }

}
