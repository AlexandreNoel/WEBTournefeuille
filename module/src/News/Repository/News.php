<?php
/**
 * Created by PhpStorm.
 * User: sphinx06
 * Date: 21/10/18
 * Time: 12:25
 */
namespace Annonce\Repository;
use \Adapter\DatabaseFactory;

class Annonce {
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
        $this->hydrator = new \Product\Hydrator\Product();
    }

    public function findAll() : array
    {
        $sql='SELECT * FROM annonce';
        foreach ($this->dbAdapter->query($sql) as $articleData) {
            $entity = new \Annonce\Entity\News();
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
            $article = new Article\Entity\Article();
            $article
                ->setId($row->id)
                ->setTitre($row->titre)
                ->setContenu($row->contenu)
                ->setIdauteur($row->Idauteur);

            $articles[] = $article;
        }

        return $articles;
    }
}