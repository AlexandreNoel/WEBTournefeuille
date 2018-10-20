<?php
/**
 * Created by PhpStorm.
 * User: theo
 * Date: 17/10/18
 * Time: 17:48
 */
namespace Product\Repository;
use Application\Adapter\DatabaseFactory;

class Product
{
    /**
     * @var \PDO
     Product
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
        $sql='SELECT * FROM utilisateur';
        foreach ($this->dbAdapter->query($sql) as $productData) {
            $entity = new \Product\Entity\Product();
            $products[] = $this->hydrator->hydrate($productData, clone $entity);
        }
        return $products;
    }
    public function update(\Product\Hydrator\Product $product)
    {
        $productArray = $this->hydrator->extract($product);
        $statement = $this->dbAdapter->prepare('update product set done_at = :doneAt where id = :id');
        $statement->bindParam(':id', $productArray['id']);
        $statement->bindParam(':doneAt', $productArray['done_at']);
        $statement->execute();
    }
    public function create (\Product\Hydrator\Product $product)
    {
        $productArray = $this->hydrator->extract($product);
        $statement = $this->dbAdapter->prepare('INSERT INTO product (idUser, Pseudo,firstname,lastname,) values (:todo_id, :name)');
        $statement->bindParam(':todo_id', $productArray['todo_id']);
        $statement->bindParam(':name', $productArray['name']);
        $statement->execute();
    }
    public function delete($productId)
    {
        $statement = $this->dbAdapter->prepare('DELETE FROM product where id = :id');
        $statement->bindParam(':id', $productId);
        $statement->execute();
    }
}