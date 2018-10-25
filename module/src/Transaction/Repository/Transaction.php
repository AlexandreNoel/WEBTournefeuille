<?php
/**
 * Created by PhpStorm.
 * User: theo
 * Date: 24/10/18
 * Time: 22:34
 */
namespace Transaction\Repository;
/**
 * Class Transaction
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
        $sql='SELECT c.*,f.prixvente,c.quantite FROM commande c join faitpartiecommande f on c.idcommande=f.idcommande';
        foreach ($this->dbAdapter->query($sql) as $productData) {
            $entity = new \Transaction\Entity\Transaction();
            $products[] = $this->hydrator->hydrate($productData, clone $entity);
        }
        return $products;
    }
    public function create (\Transaction\Entity\Transaction $product)
    {

        $productArray = $this->hydrator->extract($product);
        #insertions de la commande
        $statement = $this->dbAdapter->prepare('INSERT INTO commande (datecommande,idutilisateur,idbarmen,prixtotal) values (:datecommande,:idutilisateur,:idbarmen,:prixtotal) RETURNING idcommande');
        $statement->bindParam(':datecommande', $productArray['datecommande']);
        $statement->bindParam(':idutilisateur', $productArray['idutilisateur']);
        $statement->bindParam(':idbarmen', $productArray['idbarmen']);
        $statement->bindParam(':prixtotal', $productArray['prixtotal']);
        $statement->execute();
        $id="";
        foreach ($statement->fetchAll() as $productData) {
            $id=$productData['idcommande'];
        }
        #insertion de tous les produits de la commande
        foreach ($productArray['products'] as $product){
            $productid = $productArray['products']->current()->getId();
            $price = floatval($productArray['products']->current()->getPrice());
            $ammount = $productArray['products']->getInfo();
            $statement = $this->dbAdapter->prepare('INSERT INTO faitpartiecommande (idproduit,idcommande,prixvente,quantite) values (:idproduit,:idcommande,:prixvente,:quantite)');
            $statement->bindParam(':idproduit', $productid);
            $statement->bindParam(':idcommande', $id);
            $statement->bindParam(':prixvente', $price);
            $statement->bindParam(':quantite', $ammount);
            $statement->execute();
        }
        return $statement;


    }
}