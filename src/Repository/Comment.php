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
        $rows = $this->connection->query('SELECT * FROM "comments" ORDER BY date_comment DESC')->fetchAll();
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
        $statement = $this->connection->prepare('SELECT * FROM "comments" WHERE id_user_persons = :id_user ORDER BY date_comment DESC');
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
        $statement = $this->connection->prepare('SELECT * FROM "comments" WHERE id_resto_restos = :id_resto ORDER BY date_comment DESC');
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
     * @param $id
     * @return \Entity\Comment|null
     */
    public function findOneById($id){
        $comment = null;
        $statement = $this->connection->prepare('select * from "comments" where id_comment = :id_comment');
        $statement->bindParam(':id_comment', $id);
        $statement->execute();

        foreach ($statement->fetchAll() as $commentData) {
            $entity = new \Entity\Comment();
            $comment = $this->hydrator->hydrate($commentData, clone $entity);
        }

        return $comment;

    }

    /**
     * @param \Entity\Comment $comment
     * @return bool
     */
    public function create (\Entity\Comment $comment)
    {
        $commentArray = $this->hydrator->extract($comment);
        $statement = $this->connection->prepare('INSERT INTO comments VALUES   (DEFAULT, :text_comment, :date_comment, :id_user_persons, :id_resto_restos, :note_resto)');
        $statement->bindParam(':text_comment', $commentArray['text_comment']);
        $statement->bindParam(':date_comment', $commentArray['date_comment']);
        $statement->bindParam(':id_user_persons', $commentArray['id_user_persons']);
        $statement->bindParam(':id_resto_restos', $commentArray['id_resto_restos']);
        $statement->bindParam(':note_resto', $commentArray['note_resto']);

        return $statement->execute();
    }

    public function delete (\Entity\Comment $comment){
        $commentArray = $this->hydrator->extract($comment);
        $statement = $this->connection->prepare('DELETE FROM "comments" WHERE id_comment = :id');
        $statement->bindParam(':id', $commentArray['id_comment']);

        return $statement->execute();
    }
}