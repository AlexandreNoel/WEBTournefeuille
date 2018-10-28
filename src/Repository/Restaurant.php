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

    public function findAllByCategorie($idCategorie){
        $statement = $this->connection->prepare('SELECT * FROM "restos" NATURAL JOIN cat_resto WHERE id_cat = :id_cat');
        $statement->bindParam(':id_cat', $idCategorie);
        $statement->execute();

        $rows = $statement->fetchAll();

        $restos = [];
        foreach ($rows as $restoData) {
            $entity = new \Entity\Restaurant();
            $resto = $this->hydrator->hydrate($restoData, clone $entity);

            $restos[] = $resto;
        }

        return $restos;
    }

    public function findAllFavoritesByUser($idUser) // favorites
    {
        $statement = $this->connection->prepare('SELECT distinct nom_resto, addr_resto, city_resto FROM favoris JOIN restos ON favoris.id_resto_restos = restos.id_resto JOIN persons ON favoris.id_user_persons = persons.id_user WHERE id_user_persons = :id_user_given');
        $statement->bindParam(':id_user_given', $idUser);
        $statement->execute();

        $rows = $statement->fetchAll();

        $restos = [];
        foreach ($rows as $restoData) {
            $entity = new \Entity\Restaurant();
            $resto = $this->hydrator->hydrate($restoData, clone $entity);

            $restos[] = $resto;
        }

        return $restos;
    }


    public function isAlreadyFavorite($idUser, $idResto) // favorites
    {
        $statement = $this->connection->prepare('SELECT count(id_fav) FROM favoris WHERE id_user_persons = :id_user and id_resto_restos = :id_resto');
        $statement->bindParam(':id_user', $idUser);
        $statement->bindParam(':id_resto', $idResto);
        $statement->execute();

        $val = $statement->fetchColumn(0);
        return $val;

    }

    public function deleteFavoriteById($idUser, $idResto) // favorites
    {
        $statement = $this->connection->prepare('DELETE FROM favoris WHERE id_user_persons = :id_user and id_resto_restos = :id_resto');
        $statement->bindParam(':id_user', $idUser);
        $statement->bindParam(':id_resto', $idResto);
        return  $statement->execute();
    }

    /**
     * @param $categorie
     * @return bool
     */
    public function addCategorie($categorie){
        $statement = $this->connection->prepare('INSERT INTO categories VALUES (default, :categorie)');
        $statement->bindParam(':categorie', $categorie);
        return $statement->execute();
    }

    /**
     * @param $id_restaurant
     * @param $partnership
     * @return bool
     */
    public function addPartnership($id_restaurant, $partnership)
    {
        //Add the partnership
        $succes = $this->addCategorie($partnership);
        if (! $succes) return false;

        //Link the partnership with the restaurant
        $statement = $this->connection->prepare('SELECT MAX(id_cat) FROM categories');
        $id_cat = $statement->execute() ? $statement->fetchColumn():-1;

        $statement = $this->connection->prepare('INSERT INTO cat_resto VALUES(:id_resto, :id_cat)');
        $statement->bindParam(':id_cat', $id_cat);
        $statement->bindParam(':id_resto', $id_restaurant);

        return  $statement->execute();
    }

    /**
     * @param \Entity\Restaurant $restaurant
     * @return bool
     */
    public function create (\Entity\Restaurant $restaurant)
    {
        $restoArray = $this->hydrator->extract($restaurant);
        $statement = $this->connection->prepare('INSERT INTO restos values (DEFAULT, :nom_resto, :descr_resto, :addr_resto, :cp_resto, :city_resto, :tel_resto, :website_resto, :isdeleted, :thumbnail)');
        $statement->bindParam(':nom_resto', $restoArray['nom_resto']);
        $statement->bindParam(':descr_resto', $restoArray['descr_resto']);
        $statement->bindParam(':addr_resto', $restoArray['addr_resto']);
        $statement->bindParam(':cp_resto', $restoArray['cp_resto']);
        $statement->bindParam(':city_resto', $restoArray['city_resto']);
        $statement->bindParam(':tel_resto', $restoArray['tel_resto']);
        $statement->bindParam(':website_resto', $restoArray['website_resto']);
        $statement->bindParam(':isdeleted', $restoArray['isdeleted']);
        $statement->bindParam(':thumbnail', $restoArray['thumbnail']);

        return $statement->execute();
    }

    /**
     * @param $userId
     * @param $restaurantId
     * @return bool
     */
    public function addFavorite($userId ,$restaurantId)
    {
        $statement = $this->connection->prepare('INSERT INTO favoris values (DEFAULT, :id_user_persons, :id_resto_restos)');
        $statement->bindParam(':id_user_persons', $userId);
        $statement->bindParam(':id_resto_restos', $restaurantId);

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
                  thumbnail = :thumbnail,
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
        $statement->bindParam(':thumbnail', $restoArray['thumbnail']);
        $statement->bindParam(':id_resto', $restoArray['id_resto']);

        return $statement->execute();
    }
}