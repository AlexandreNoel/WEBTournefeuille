<?php

namespace Repository;

use \Adapter\DatabaseFactory;

class Restaurant
{

    /**
     * @var \PDO
     */
    private $connection;

    /**
     * @var \Hydrator\Restaurant
     */
    private $hydrator;

    /**
     * Restaurant constructor.
     * @param \PDO $connection
     */
    public function __construct()
    {
        $dbFactory = new DatabaseFactory();
        $this->connection = $dbFactory->getDbAdapter();
        $this->hydrator = new \Hydrator\Restaurant();
    }

    /**
     * @return array
     */
    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "restos"')->fetchAll();
        $restos = [];
        foreach ($rows as $restoData) {
            $entity = new \Entity\Restaurant();
            $resto = $this->hydrator->hydrate($restoData, clone $entity);

            $restos[] = $resto;
        }

        return $restos;
    }

    public function findAllNoDeleted()
    {
        $rows = $this->connection->query('SELECT * FROM "restos" where isDeleted is FALSE ')->fetchAll();
        $restos = [];
        foreach ($rows as $restoData) {
            $entity = new \Entity\Restaurant();
            $resto = $this->hydrator->hydrate($restoData, clone $entity);

            $restos[] = $resto;
        }

        return $restos;
    }

    public function findAllDeleted()
    {
        $rows = $this->connection->query('SELECT * FROM "restos" where isDeleted is TRUE ')->fetchAll();
        $restos = [];
        foreach ($rows as $restoData) {
            $entity = new \Entity\Restaurant();
            $resto = $this->hydrator->hydrate($restoData, clone $entity);

            $restos[] = $resto;
        }

        return $restos;
    }


    /**
     * @param $name
     * @return \Entity\Restaurant|null
     */
    public function findOneByName($name)
    {
        $resto = null;
        $statement = $this->connection->prepare('select * from "restos" where nom_resto = :name_resto');
        $statement->bindParam(':name_resto', $name);
        $statement->execute();

        foreach ($statement->fetchAll() as $restoData) {
            $entity = new \Entity\Restaurant();
            $resto = $this->hydrator->hydrate($restoData, clone $entity);
        }

        return $resto;
    }



    /**
     * @param $id
     * @return \Entity\Restaurant|null
     */
    public function findOneById($id)
    {
        $resto = null;
        $statement = $this->connection->prepare('select * from "restos" where id_resto = :id_resto');
        $statement->bindParam(':id_resto', $id);
        $statement->execute();

        foreach ($statement->fetchAll() as $restoData) {
            $entity = new \Entity\Restaurant();
            $resto = $this->hydrator->hydrate($restoData, clone $entity);
        }

        return $resto;
    }

    /**
     * @param \Entity\Restaurant $restaurant
     * @return bool
     */
    public function create (\Entity\Restaurant $restaurant)
    {
        $restoArray = $this->hydrator->extract($restaurant);
        $statement = $this->connection->prepare('INSERT INTO restos values (DEFAULT, :nom_resto, :descr_resto, :addr_resto, :cp_resto, :city_resto, :tel_resto, :website_resto, :isdeleted)');
        $statement->bindParam(':nom_resto', $restoArray['nom_resto']);
        $statement->bindParam(':descr_resto', $restoArray['descr_resto']);
        $statement->bindParam(':addr_resto', $restoArray['addr_resto']);
        $statement->bindParam(':cp_resto', $restoArray['cp_resto']);
        $statement->bindParam(':city_resto', $restoArray['city_resto']);
        $statement->bindParam(':tel_resto', $restoArray['tel_resto']);
        $statement->bindParam(':website_resto', $restoArray['website_resto']);
        $statement->bindParam(':isdeleted', $restoArray['isdeleted']);

        return $statement->execute();
    }

    /**
     * @param \Entity\Restaurant $restaurant
     * @return bool
     */
    public function delete(\Entity\Restaurant $restaurant){
        $restoArray = $this->hydrator->extract($restaurant);
        $statement = $this->connection->prepare('UPDATE restos SET isdeleted = :isdeleted WHERE id_resto = :id');
        $statement->bindParam(':isdeleted', $restoArray['isdeleted']);
        $statement->bindParam(':id', $restoArray['id_resto']);

        return $statement->execute();
    }


    public function update(\Entity\Restaurant $restaurant){
        $restoArray = $this->hydrator->extract($restaurant);
        $sql = 'UPDATE restos 
                SET nom_resto = :nom_resto,
                  descr_resto = :descr_resto,
                  addr_resto = :addr_resto,
                  cp_resto = :cp_resto,
                  city_resto = :city_resto,
                  tel_resto = :tel_resto,
                  website_resto = :website_resto
                WHERE id_resto = :id_resto';

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':nom_resto', $restoArray['nom_resto']);
        $statement->bindParam(':descr_resto', $restoArray['descr_resto']);
        $statement->bindParam(':addr_resto', $restoArray['addr_resto']);
        $statement->bindParam(':cp_resto', $restoArray['cp_resto']);
        $statement->bindParam(':city_resto', $restoArray['city_resto']);
        $statement->bindParam(':tel_resto', $restoArray['tel_resto']);
        $statement->bindParam(':website_resto', $restoArray['website_resto']);
        $statement->bindParam(':id_resto', $restoArray['id_resto']);

        return $statement->execute();
    }

}