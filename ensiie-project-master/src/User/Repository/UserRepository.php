<?php
namespace User\Repository;
include_once '../../../src/User/Hydrator/User.php';
include_once '../../../src/Adapter/DatabaseFactory.php';
include_once '../../../src/User/Entity/User.php';
class UserRepository
{
    /**
     * @var \PDO 
     */
    private $connection;

    /**
     * UserRepository constructor.
     * @param \PDO $connection
     */
    public function __construct()
    {
        $this->hydrator = new \User\Hydrator\User();
        $this->dbAdapter = new \Adapter\DatabaseFactory();
        $this->dbAdapterFunction= $this->dbAdapter->getDbAdapter();

    }

    public function findByOne($mail,$password){
        $user = null;
        $statement = $this->dbAdapterFunction->prepare('SELECT * FROM "userf" where mail=:mail and passwordp=:password');
        $statement->bindparam(':mail',$mail);
        $statement->bindParam(':password',$password);
        $statement->execute();
        $rows = $statement->fetchAll();
        foreach ($rows as $row){
            $entity = new \User\Entity\User();
            $user = $this->hydrator->hydrate($row, $entity);
        }
        return $user; 
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "userf"')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
                $user->setId($row->id);
                $user->setName($row->nameu);
                $user->setLastname($row->lastname);
                $user->setUsername($row->username);
                $user->setPassword($row->passwordp);
                $user->setMail($row->mail);
            $users[] = $user;
        }
        return $users;
    } 

    public function createUser(\User\Entity\User $userObject,$genreTable,$idGenre){
        try{
            $taskArray = $this->hydrator->extract($userObject);
            $statement = $this->dbAdapterFunction->prepare('INSERT INTO "userf"(nameu,passwordp,lastname,username,mail) VALUES(:nameu,:passwordp,:lastname,:username,:mail) returning id');
            $statement->bindParam(':nameu',$taskArray["nameu"]);
            $statement->bindParam(':lastname',$taskArray["lastname"]);
            $statement->bindParam(':passwordp',$taskArray["passwordp"]);
            $statement->bindParam(':username',$taskArray["username"]);
            $statement->bindParam(':mail',$taskArray["mail"]);
            $statement->execute();
            $lastId = $this->dbAdapterFunction->lastInsertId();
            $statement=$this->dbAdapterFunction->prepare('INSERT INTO '.$genreTable.'('.$idGenre.')VALUES (:lastId)');
            $statement->bindParam(':lastId',$lastId);
            $statement->execute();
            echo 'Success';
        }catch(PDOException $ex){
            echo $ex->getMessage();
        }

    }



}
// new \DateTimeImmutable($row->birthday));