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

    public function create(\News\Entity\News $news) : void
    {
        $data = $this->hydrator->extract($news);
        $statement = $this->dbAdapter->prepare('INSERT INTO "annonce" (titre, contenu, idauteur) values (:titre, :contenu, :idauteur)');
        $statement->bindParam(':titre', $data['titre']);
        $statement->bindParam(':contenu',$data['contenu']);
        $statement->bindParam(':idauteur',$data['idauteur']);
        $statement->execute();
    }

    public function delete($newsid) : void
    {
        $statement = $this->dbAdapter->prepare('DELETE FROM "annonce" WHERE idannonce = :idannonce');
        $statement->bindParam(':idannonce', $newsid);
        $statement->execute();
    }

    /**
     * @param int $number
     * @return array
     */
    public function findLast($number) : array
    {
        $news = [];
        $statement = $this->dbAdapter->prepare('SELECT  * FROM annonce ORDER BY dateCreation DESC LIMIT :number');
        $statement->bindParam(":number",$number);
        $statement->execute();
        foreach ($statement->fetchAll() as $row) {
            $entity = new \News\Entity\News();
            $news[] = $this->hydrator->hydrate($row, clone $entity);
        }
        return $news;
    }

    /**
     * @param int $number
     * @return array
     */
    public function findLastNews() : ?\News\Entity\News
    {
        $newsarray = $this->findLast(1);
        foreach ($newsarray as $newsentry) {
            return $newsentry;
        }
        return null;
    }
}