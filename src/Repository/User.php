<?php

namespace Repository;

use \Adapter\DatabaseFactory;

class User
{
    /**
     * @var \PDO
     */
    private $connection;

    private $hydrator;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $dbFactory = new DatabaseFactory();
        $this->connection = $dbFactory->getDbAdapter();
        $this->hydrator = new \Hydrator\User();
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "persons"')->fetchAll();
        $users = [];
        foreach ($rows as $userData) {
            $entity = new \Entity\User();
            $user = $this->hydrator->hydrate($userData, clone $entity);

            $users[] = $user;
        }

        return $users;
    }

    /**
     * @param $mail
     * @return null|\Entity\User
     */
    public function findOneByMail($mail)
    {
        $user = null;
        $statement = $this->connection->prepare('select * from "persons" where mail_user = :mail');
        $statement->bindParam(':mail', $mail);
        $statement->execute();

        foreach ($statement->fetchAll() as $userData) {
            $entity = new \Entity\User();
            $user = $this->hydrator->hydrate($userData, clone $entity);
        }

        return $user;
    }

    public function getIdByMail($mail){
        
        $statement = $this->connection->prepare('select id_user from "persons" where mail_user = :mail');
        $statement->bindParam(':mail', $mail);
        $statement->execute();
        
       return $statement->fetchColumn(0);

    }

    public function checkRightById($id)
    {

        $statement = $this->connection->prepare('select isadmin from "persons" where id_user = :id');
        $statement->bindParam(':id', $id);
        $statement->execute();
        return $statement->fetchColumn(0);

    }

    /**
     * @param \Entity\User $user
     * @return bool
     */
    public function updateRight($isadmin,$id)
    {
        $isadminStr =(!$isadmin) ? 'true' : 'false';


        $statement = $this->connection->prepare('UPDATE persons SET isadmin = :isadmingiven WHERE id_user = :id');
        $statement->bindParam(':isadmingiven', $isadminStr);
        $statement->bindParam(':id', $id);

        return $statement->execute(); 
    }
   

    /**
     * @param $userId
     * @return null|\Entity\User
     */
    public function findOneById($userId)
    {
        $user = null;
        $statement = $this->connection->prepare('select * from "persons" where id_user = :id_user');
        $statement->bindParam(':id_user', $userId);
        $statement->execute();

        foreach ($statement->fetchAll() as $userData) {
            $entity = new \Entity\User();
            $user = $this->hydrator->hydrate($userData, clone $entity);
        }

        return $user;
    }

    /**
     * @param \Entity\User $user
     * @return bool
     */
    public function create (\Entity\User $user)
    {
        $userArray = $this->hydrator->extract($user);
        $statement = $this->connection->prepare('INSERT INTO persons values (DEFAULT, :nom_user, :prenom_user, :mail_user, :promo_user, :isadmin, :secret_user)');
        $statement->bindParam(':nom_user', $userArray['nom_user']);
        $statement->bindParam(':prenom_user', $userArray['prenom_user']);
        $statement->bindParam(':mail_user', $userArray['mail_user']);
        $statement->bindParam(':promo_user', $userArray['promo_user']);
        $statement->bindParam(':isadmin', $userArray['isadmin']);
        $statement->bindParam(':secret_user', $userArray['secret_user']);
        return $statement->execute();
      }

    /**
     * @param \Entity\User $user
     * @return bool
     */
    public function updatePassword(\Entity\User $user)
    {
        $userArray = $this->hydrator->extract($user);
        $statement = $this->connection->prepare('UPDATE persons SET secret_user = :secret_user WHERE id_user = :id');
        $statement->bindParam(':id', $userArray['id']);
        $statement->bindParam(':secret_user', $userArray['secret_user']);

       return $statement->execute();
    }

    /**
     * @param \Entity\User $user
     * @return bool
     */
    public function update(\Entity\User $user){
        $userArray = $this->hydrator->extract($user);

        $sql = 'UPDATE "persons"
                SET prenom_user = :prenom_user,
                    nom_user = :nom_user,
                    mail_user = :mail_user,
                    promo_user = :promo_user,
                    secret_user = :secret_user
                WHERE id_user = :id';
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':prenom_user', $userArray['prenom_user']);
        $statement->bindParam(':nom_user', $userArray['nom_user']);
        $statement->bindParam(':mail_user', $userArray['mail_user']);
        $statement->bindParam(':promo_user', $userArray['promo_user']);
        $statement->bindParam(':secret_user', $userArray['secret_user']);
        $statement->bindParam(':id', $userArray['id_user']);

        return  $statement->execute();

    }
}
