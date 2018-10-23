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
    public function __construct(\PDO $connection)
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


}
