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
     * @param \PDO $connection
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
        $statement = $this->connection->prepare('UPDATE persons set secret_user = :secret_user where id = :id');
        $statement->bindParam(':id', $userArray['id']);
        $statement->bindParam(':secret_user', $userArray['secret_user']);

       return $statement->execute();
    }

}
