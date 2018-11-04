<?php

namespace Repository;

use \Adapter\DatabaseFactory;

class Categorie
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * @var \Hydrator\Categorie
     */
    private $hydrator;

    /**
     * Categorie constructor.
     * @param \PDO $connection
     */
    public function __construct()
    {
        $dbFactory = new DatabaseFactory();
        $this->connection = $dbFactory->getDbAdapter();
        $this->hydrator = new \Hydrator\Categorie();
    }

    /**
     * @return array
     */
    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "categories"')->fetchAll();
        $cats = [];
        foreach ($rows as $catData) {
            $entity = new \Entity\Categorie();
            $cat = $this->hydrator->hydrate($catData, clone $entity);

            $cats[] = $cat;
        }

        return $cats;
    }


    /**
     * @param $name
     * @return \Entity\Categorie|null
     */
    public function findOneByName($name)
    {
        $cat = null;
        $statement = $this->connection->prepare('select * from "categories" where nom_cat = :name_cat');
        $statement->bindParam(':name_cat', $name);
        $statement->execute();

        foreach ($statement->fetchAll() as $catData) {
            $entity = new \Entity\Categorie();
            $cat = $this->hydrator->hydrate($catData, clone $entity);
        }

        return $cat;
    }

    /**
     * @param int,int
     * @return bool
     */
    public function associateCategorie($restaurantId, $id)
    {
            $statement = $this->connection->prepare('INSERT INTO cat_resto values (:id_resto, :id_cat)');
            $statement->bindParam(':id_resto', $restaurantId);
            $statement->bindParam(':id_cat', $id);

            return $statement->execute();
    }
    
    /**
     * @param $id
     * @return \Entity\Categorie|null
     */
    public function findOneById($id)
    {
        $cat = null;
        $statement = $this->connection->prepare('select * from "categories" where id_cat = :id_cat');
        $statement->bindParam(':id_cat', $id);
        $statement->execute();

        foreach ($statement->fetchAll() as $catData) {
            $entity = new \Entity\Categorie();
            $cat = $this->hydrator->hydrate($catData, clone $entity);
        }

        return $cat;
    }

    /**
     * @param $idResto
     * @return array
     */
    public function findOneByResto($idResto){
        $statement = $this->connection->prepare('SELECT nom_cat FROM "categories" NATURAL JOIN cat_resto WHERE id_resto = :id_resto');
        $statement->bindParam(':id_resto', $idResto);
        $statement->execute();
        $cat = $statement->fetchColumn(0);
        return $cat;
    }

    /**
     * @param \Entity\Categorie $categorie
     * @return bool
     */
    public function create (\Entity\Categorie $categorie)
    {
        $catArray = $this->hydrator->extract($categorie);
        $statement = $this->connection->prepare('INSERT INTO categories values (DEFAULT, :nom_cat)');
        $statement->bindParam(':nom_cat', $catArray['nom_cat']);

        return $statement->execute();
    }

}