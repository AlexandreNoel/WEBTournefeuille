<?php
/**
 * Created by PhpStorm.
 * User: theo
 * Date: 24/10/18
 * Time: 22:34
 */
namespace Transaction\Repository;
/**
 * Class Product
 * @package \Transaction\Repository
 */
use \Adapter\DatabaseFactory;

class Transaction
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
        $this->hydrator = new \Transaction\Hydrator\Transaction();
    }

    public function findAll() : array
    {
        $sql='SELECT * FROM commande';
        foreach ($this->dbAdapter->query($sql) as $productData) {
            $entity = new \Transaction\Entity\Transaction();
            $products[] = $this->hydrator->hydrate($productData, clone $entity);
        }
        return $products;
    }
}