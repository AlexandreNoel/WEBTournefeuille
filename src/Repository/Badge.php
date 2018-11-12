<?php

namespace Repository;

use \Adapter\DatabaseFactory;

class Badge
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * @var \Hydrator\Badge
     */
    private $hydrator;

    /**
     * Badge constructor.
     * @param \PDO $connection
     */
    public function __construct()
    {
        $dbFactory = new DatabaseFactory();
        $this->connection = $dbFactory->getDbAdapter();
        $this->hydrator = new \Hydrator\Badge();
    }

    /**
     * @return array
     */
    public function fetchAll()
    {
        $badges =  [];

        $rows = $this->connection->query('SELECT * FROM "badge"')->fetchAll();

        foreach ($rows as $badgeData) {
            $entity = new \Entity\Badge();
            $badge = $this->hydrator->hydrate($badgeData, clone $entity);

            $badges[] = $badge;
        }

        return $badges;
    }


    /**
     * @param $name
     * @return \Entity\Badge|null
     */
    public function findOneByName($name)
    {
        $badge = null;

        $statement = $this->connection->prepare('select * from "badge" where nom_badge = :name_badge');
        $statement->bindParam(':name_badge', $name);
        $statement->execute();

        foreach ($statement->fetchAll() as $badgeData) {
            $entity = new \Entity\Badge();
            $badge = $this->hydrator->hydrate($badgeData, clone $entity);
        }

        return $badge;
    }

    /**
     * @param int,int
     * @return bool
     */
    public function associateBadges($restaurantId, $ids)
    {

        //Clear Badges
        $stat = $this->connection->prepare('DELETE FROM badge_resto WHERE id_resto = :id_resto');
        $stat->bindParam(':id_resto', $restaurantId);
        if ( ! $stat->execute()){
            return false;
        }


        //Add badges
        for ($i=0; $i < count($ids) ; $i++) {
            $id = intval($ids[$i]);
            $statement = $this->connection->prepare('INSERT INTO badge_resto values (:id_resto, :id_badge)');
            $statement->bindParam(':id_resto', $restaurantId);
            $statement->bindParam(':id_badge', $id);
            if(!$statement->execute()){
                return false;
            }
        }
        return true;
    }

    /**
     * @param $id
     * @return \Entity\Badge|null
     */
    public function findOneById($id)
    {
        $badge = null;
        $statement = $this->connection->prepare('select * from "badge" where id_badge = :id_badge');
        $statement->bindParam(':id_badge', $id);
        $statement->execute();

        foreach ($statement->fetchAll() as $badgeData) {
            $entity = new \Entity\Badge();
            $badge = $this->hydrator->hydrate($badgeData, clone $entity);
        }

        return $badge;
    }

    /**
     * @param $idResto
     * @return array
     */
    public function findAllByResto($idResto){
        $statement = $this->connection->prepare('SELECT * FROM "badge" NATURAL JOIN badge_resto WHERE id_resto = :id_resto');
        $statement->bindParam(':id_resto', $idResto);
        $statement->execute();
        return  $statement->fetchAll();
    }

    /**
     * @param \Entity\Badge $badge
     * @return bool
     */
    public function create (\Entity\Badge $badge)
    {
        $badgeArray = $this->hydrator->extract($badge);
        $statement = $this->connection->prepare('INSERT INTO badge values (DEFAULT, :nom_cat, :badge_link)');
        $statement->bindParam(':nom_cat', $badgeArray['nom_cat']);
        $statement->bindParam(':badge_link', $badgeArray['badge_link']);

        return $statement->execute();
    }

}