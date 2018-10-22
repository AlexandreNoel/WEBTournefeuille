<?php

namespace Repository;

class User
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * User constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
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
        $statement = $this->dbAdapter->prepare('select * from "persons" where id_user = :id_user');
        $statement->bindParam(':id_user', $userId);
        $statement->execute();

        foreach ($statement->fetchAll() as $userData) {
            $entity = new \Entity\User();
            $user = $this->hydrator->hydrate($userData, clone $entity);
        }

        return $user;
    }
}
