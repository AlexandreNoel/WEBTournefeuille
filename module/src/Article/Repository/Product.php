<?php
/**
 * Created by PhpStorm.
 * User: theo
 * Date: 17/10/18
 * Time: 17:48
 */
namespace Product\Repository;
use \Adapter\DatabaseFactory;
class Product
{
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
            $entity = new \Article\Entity\Article();
            $articles[] = $this->hydrator->hydrate($articleData, clone $entity);
        }
        return $articles;
    }
    
    public function findById($id)
    {
        $$article = null;
        $statement = $this->dbAdapter->prepare('select * from annonce where idannonce = :id');
        $statement->bindParam(':id', $id);
        $statement->execute();
        foreach ($statement->fetchAll() as $articleData) {
            $entity = new \Article\Entity\Article();
            $article = $this->hydrator->hydrate($articleData, clone $entity);
        }
        return $article;
    }
    public function update(\Product\Entity\Product $product)
    {
        $productArray = $this->hydrator->extract($product);
        $statement = $this->dbAdapter->prepare('update produit set libelle = :name,prix = :price,reduction = :reduction,quantite = :quantity,idFamille = :idfamilly where id = :id');
        $statement->bindParam(':name', $productArray['name']);
        $statement->bindParam(':price', $productArray['price']);
        $statement->bindParam(':reduction', $productArray['reduction']);
        $statement->bindParam(':quantity', $productArray['quantity']);
        $statement->bindParam(':idfamilly', $productArray['idfamilly']);
        $statement->execute();
    }
    public function create (\Product\Entity\Product $product)
    {
        $productArray = $this->hydrator->extract($product);
        $statement = $this->dbAdapter->prepare('INSERT INTO produit (libelle,prix,reduction,quantitestock,idcategorie) values (:libelle, :prix,:reduction,:idcategorie,:quantitestock)');
        $statement->bindParam(':libelle', $productArray['libelle']);
        $statement->bindParam(':prix', $productArray['prix']);
        $statement->bindParam(':reduction', $productArray['reduction']);
        $statement->bindParam(':quantitestock', $productArray['quantitestock']);
        $statement->bindParam(':idcategorie', $productArray['idcategorie']);
        $statement->execute();
    }
    public function delete($productId)
    {
        $statement = $this->dbAdapter->prepare('DELETE FROM produit where id = :id');
        $statement->bindParam(':id', $productId);
        $statement->execute();
    }
}