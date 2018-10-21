<?php
/**
 * Created by PhpStorm.
 * User: sphinx06
 * Date: 21/10/18
 * Time: 12:25
 */

namespace Repository\;
class Article {
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * UserRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param int $number
     * @return array
     * @throws \Exception
     */
    public function fetchTop($number)
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