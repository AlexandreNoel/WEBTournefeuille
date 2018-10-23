<?php

namespace News\Repository;
use \Adapter\DatabaseFactory;

class News {
    /**
     * @var \PDO
     **/
    private $connection;
    /**
     * UserRepository constructor.
     * @param \PDO $connection
     */
    public function __construct()
    {
        $dbFactory = new DatabaseFactory();
        $this->dbAdapter = $dbFactory->getDbAdapter();
        $this->hydrator = new \News\Hydrator\News();
    }

    public function findAll() : array
    {
        $sql='SELECT * FROM annonce';
        foreach ($this->dbAdapter->query($sql) as $articleData) {
            $entity = new \News\Entity\News();
            $articles[] = $this->hydrator->hydrate($articleData, clone $entity);
        }
        return $articles;
    }

    /**
     * @param int $number
     * @return array
     * @throws \Exception
     */
    public function findLast($number)
    {
        $rows = $this->connection->query('SELECT TOP $number * FROM annonce')->fetchAll(\PDO::FETCH_OBJ);
        $articles = [];
        foreach ($rows as $row) {
            $article = new News\Entity\News();
            $article
                ->setId($row->id)
                ->setTitle($row->titre)
                ->setContenu($row->contenu)
                ->setIdauteur($row->Idauteur);

            $articles[] = $article;
        }

        return $articles;
    }
}