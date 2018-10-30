<?php

namespace Repository;


use \Adapter\DatabaseFactory;

class Comment
{

    /**
     * @var \PDO
     */
    private $connection;

    /**
     * @var \Hydrator\Comment
     */
    private $hydrator;

    /**
     * Comment constructor.
     * @param \PDO $connection
     */
    public function __construct()
    {
        $dbFactory = new DatabaseFactory();
        $this->connection = $dbFactory->getDbAdapter();
        $this->hydrator = new \Hydrator\Comment();
    }

    /**
     * @return array
     */
    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "comments"')->fetchAll();
        $comments = [];
        foreach ($rows as $commentData) {
            $entity = new \Entity\Comment();
            $comment = $this->hydrator->hydrate($commentData, clone $entity);

            $comments[] = $comment;
        }

        return $comments;
    }

    /**
     * @param $id_user
     * @return array
     */
    public function findAllByUser($id_user){
        $statement = $this->connection->prepare('SELECT * FROM "comments" WHERE id_user_persons = :id_user');
        $statement->bindParam(':id_user', $id_user);
        $statement->execute();

        $rows = $statement->fetchAll();

        $comments = [];
        foreach ($rows as $commentData) {
            $entity = new \Entity\Comment();
            $comment = $this->hydrator->hydrate($commentData, clone $entity);

            $comments[] = $comment;
        }

        return $comments;
    }

    /**
     * @param $id_resto
     * @return array
     */
    public function findAllByResto($id_resto){
        $statement = $this->connection->prepare('SELECT * FROM "comments" WHERE id_resto_restos = :id_resto');
        $statement->bindParam(':id_resto', $id_resto);
        $statement->execute();

        $rows = $statement->fetchAll();

        $comments = [];
        foreach ($rows as $commentData) {
            $entity = new \Entity\Comment();
            $comment = $this->hydrator->hydrate($commentData, clone $entity);

            $comments[] = $comment;
        }

        return $comments;
    }

    /**
     * @param \Entity\Comment $comment
     * @return bool
     */
    public function create (\Entity\Comment $comment)
    {
        $commentArray = $this->hydrator->extract($comment);
        $statement = $this->connection->prepare('INSERT INTO comments values (DEFAULT, :text_comment, :date_comment, :id_user_persons, :id_resto_restos, :note_resto)');
        $statement->bindParam(':text_comment', $commentArray['text_comment']);
        $statement->bindParam(':date_comment', $commentArray['date_comment']);
        $statement->bindParam(':id_user_persons', $commentArray['id_user']);
        $statement->bindParam(':id_resto_restos', $commentArray['id_resto']);
        $statement->bindParam(':note_resto', $commentArray['score_comment']);

        return $statement->execute();
    }
}