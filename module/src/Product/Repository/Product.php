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

    public function getCategories() : array
    {
        $categories[] = null;
        $statement = $this->dbAdapter->prepare('SELECT * FROM categorie');
        $statement->execute();
        return $statement->fetchAll();

    }

    public function findAll() : array
    {
        $sql='SELECT * FROM produit';
        foreach ($this->dbAdapter->query($sql) as $productData) {
            $entity = new \Product\Entity\Product();
            $products[] = $this->hydrator->hydrate($productData, clone $entity);
        }
        return $products;
    }

    public function findByCategory($id) : array
    {
        $product[] = null;
        $statement = $this->dbAdapter->prepare('SELECT * FROM produit WHERE idcategorie = :id AND estdisponible = True');
        $statement->bindParam(':id', $id);
        $statement->execute();
        foreach ($statement->fetchAll() as $productData) {
            $entity = new \Product\Entity\Product();
            $product[] = $this->hydrator->hydrate($productData, clone $entity);
        }
        return $product;
    }

    public function findDeletedItems() : array
    {
        $product = [];
        $statement = $this->dbAdapter->prepare('SELECT * FROM produit WHERE estdisponible = False');
        $statement->execute();
        foreach ($statement->fetchAll() as $productData) {
            $entity = new \Product\Entity\Product();
            $product[] = $this->hydrator->hydrate($productData, clone $entity);
        }
        return $product;
    }

    public function findAllByCategory() : array
    {
        $productslist = [];
        $categories = $this->getCategories();
        foreach ($categories as $category) {
            $productslist[$category["libelle"]] = $this->findByCategory($category["idcategorie"]);
        }
        return $productslist;
    }

    public function findById($id)
    {
        $product = null;
        $statement = $this->dbAdapter->prepare('select * from produit where idproduit = :id');
        $statement->bindParam(':id', $id);
        $statement->execute();
        foreach ($statement->fetchAll() as $productData) {
            $entity = new \Product\Entity\Product();
            $product = $this->hydrator->hydrate($productData, clone $entity);
        }
        return $product;
    }

    public function findByName($libelle)
    {
        $product = null;
        $statement = $this->dbAdapter->prepare('select * from produit where libelle = :libelle  and estdisponible = True');
        $statement->bindParam(':libelle', $libelle);
        $statement->execute();
        foreach ($statement->fetchAll() as $productData) {
            $entity = new \Product\Entity\Product();
            $product = $this->hydrator->hydrate($productData, clone $entity);
        }
        return $product;
    }

    public function modifyStock($id, $stock)
    {
        $quantityProduct = $this->findById($id)->getQuantity();
        if (($quantityProduct - $stock) > 0) {
            $statement = $this->dbAdapter->prepare('UPDATE produit SET quantitestock=quantitestock + :stock WHERE idproduit=:id');
            $statement->bindParam(":stock", $stock);
            $statement->bindParam(":id", $id);
            $statement->execute();
            return $this->findById($id)->getQuantity();
        } else {
            throw new \Exception("Stock trop faible");
        }
    }


    public function update(\Product\Entity\Product $product)
    {
        $productArray = $this->hydrator->extract($product);
        $statement = $this->dbAdapter->prepare('update produit set libelle = :name,prix = :price,reduction = :reduction,quantitestock = :quantity,idcategorie = :idfamilly,estdisponible=:estdisponible where idproduit = :id');
        $statement->bindParam(':name', $productArray['libelle']);
        $statement->bindParam(':price', $productArray['prix']);
        $statement->bindParam(':reduction', $productArray['reduction']);
        $statement->bindParam(':quantity', $productArray['quantitestock']);
        $statement->bindParam(':idfamilly', $productArray['idcategorie']);
        $statement->bindParam(':estdisponible', $productArray['estdisponible']);
        $statement->bindParam(':id', $productArray["idproduit"]);
        $statement->execute();
        return $statement;
    }

    public function create (\Product\Entity\Product $product)
    {
        $productArray = $this->hydrator->extract($product);
        $statement = $this->dbAdapter->prepare('INSERT INTO produit (libelle,prix,reduction,quantitestock,idcategorie,estdisponible) values (:libelle, :prix,:reduction,:quantitestock,:idcategorie,:estdisponible) RETURNING Idproduit');
        $statement->bindParam(':libelle', $productArray['libelle']);
        $statement->bindParam(':prix', $productArray['prix']);
        $statement->bindParam(':reduction', $productArray['reduction']);
        $statement->bindParam(':quantitestock', $productArray['quantitestock']);
        $statement->bindParam(':estdisponible', $productArray['estdisponible']);
        $statement->bindParam(':idcategorie', $productArray['idcategorie']);
        $statement->execute();
        $id="";
        foreach ($statement->fetchAll() as $productData) {
            $id=$productData['idproduit'];
        }
        return $id;


    }

    public function delete($productId)
    {
        $statement = $this->dbAdapter->prepare('UPDATE produit SET estdisponible = False WHERE idproduit = :idproduit');
        $statement->bindParam(':idproduit', $productId);
        $statement->execute();
    }

    public function deleteByName($productName)
    {
        $statement = $this->dbAdapter->prepare('DELETE FROM produit where libelle = :libelle');
        $statement->bindParam(':libelle', $productName);
        $statement->execute();
    }
    public function getMostSelled($top){
        $statement = $this->dbAdapter->prepare(
            'select idproduit,sum(quantite) as quantite from faitpartiecommande group by idproduit limit :top;');
        $statement->bindParam(':top', $top);
        $statement->execute();
        foreach ($statement->fetchAll() as $productData) {
            $res[]=$productData;
        }
        return $res;

    }
}