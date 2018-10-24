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
     * @param \PDO $connection
     */
    public function __construct()
    {
        $dbFactory = new DatabaseFactory();
        $this->dbAdapter = $dbFactory->getDbAdapter();
        $this->hydrator = new \Client\Hydrator\Client();
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "user"')->fetchAll(\PDO::FETCH_OBJ);
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
        $statement = $this->dbAdapter->prepare('select * from Utilisateur where idUtilisateur = :id');
        $statement->bindParam(':id', $id);
        $statement->execute();
        foreach ($statement->fetchAll() as $row){
            $entity = new \Client\Entity\Client();
            $user = $this->hydrator->hydrate($row, clone $entity);
        }
        return $user;
    }

    public function findByAriseData($lastname,$firstname,$nickname)
    {
        $user = null;

        $statement = $this->dbAdapter->prepare('select * from Utilisateur where nom = :lastname AND prenom = :firstname AND pseudo = :nickname');
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
        $statement->execute();
    }

}
