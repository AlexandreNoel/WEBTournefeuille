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
        $productRepository = new \Product\Repository\Product();
        $products = new \SplObjectStorage();
        $commandes=[];
        #Récupération de chaque commande
        $statement = $this->dbAdapter->prepare(
            'SELECT * FROM commande');
        $statement->execute();
        #Pöur chaque commande il faut trouver tous les articles associés
        foreach ($statement->fetchAll() as $commandData) {
            $entity = new \Transaction\Entity\Transaction();
            $idcommande = $commandData['idcommande'];
            #récupération de chaque contenu de commande pour chaque commande
            $statement2 = $this->dbAdapter->prepare(
                'SELECT idproduit,quantite FROM  faitpartiecommande f where f.idcommande=:idcommande');
            $statement2->bindParam(':idcommande', $idcommande);
            $statement2->execute();
            #construction du tableau produit->quanitte
            foreach ($statement2->fetchAll() as $productsData) {
                $productid = $productsData['idproduit'];
                $ammount = $productsData['quantite'];
                $product=$productRepository->findById($productid);
                #on ajoute un produit et sa quantite au tableau "articles=>quantite'
                $products->attach($product,$ammount);

            }
            #on ajoute le tableau de produits construit à la commande
            $commandData['products']=$products;
            $commandes[] = $this->hydrator->hydrate($commandData, clone $entity);


        }

        return $commandes;
    }
    public function create (\Transaction\Entity\Transaction $product) :int
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
        return intval($id);


    }
    public function findOneById($id){
        #récupération de toules articles compris dans la commande
        $statement = $this->dbAdapter->prepare(
            'SELECT idproduit,quantite FROM  faitpartiecommande f where f.idcommande=:idcommande');
        $statement->bindParam(':idcommande', $id);
        $statement->execute();
        $productRepository = new \Product\Repository\Product();
        $products = new \SplObjectStorage();
        #construction du tableau produit->quanitte
        foreach ($statement->fetchAll() as $productData) {
            $productid = $productData['idproduit'];
            $ammount = $productData['quantite'];
            $product=$productRepository->findById($productid);
            #on ajoute un produit et sa quantite au tableau "articles=>quantite'
            $products->attach($product,$ammount);

        }
        #Récupération de la commande
        $statement2 = $this->dbAdapter->prepare(
            'SELECT * FROM commande  where idcommande=:idcommande');
        $statement2->bindParam(':idcommande', $id);
        $statement2->execute();
        $product=null;
        foreach ($statement2->fetchAll() as $commandeData) {
            $entity = new \Transaction\Entity\Transaction();
            $commandeData['products']=$products;
            $product = $this->hydrator->hydrate($commandeData, clone $entity);
        }
        return $product;
    }

    public function findByCriteria($criteria,$value){
        $productRepository = new \Product\Repository\Product();
        $products = new \SplObjectStorage();
        $commandes=[];
        #Récupération de chaque commande
        $statement = $this->dbAdapter->prepare(
            "SELECT * FROM commande where $criteria =:value");
        $statement->bindParam(':value', $value);
        $statement->execute();
        #Pöur chaque commande il faut trouver tous les articles associés
        foreach ($statement->fetchAll() as $commandData) {
            $entity = new \Transaction\Entity\Transaction();
            $idcommande = $commandData['idcommande'];
            #récupération de chaque contenu de commande pour chaque commande
            $statement2 = $this->dbAdapter->prepare(
                'SELECT idproduit,quantite FROM  faitpartiecommande f where f.idcommande=:idcommande');
            $statement2->bindParam(':idcommande', $idcommande);
            $statement2->execute();
            #construction du tableau produit->quanitte
            foreach ($statement2->fetchAll() as $productsData) {
                $productid = $productsData['idproduit'];
                $ammount = $productsData['quantite'];
                $product=$productRepository->findById($productid);
                #on ajoute un produit et sa quantite au tableau "articles=>quantite'
                $products->attach($product,$ammount);

            }
            #on ajoute le tableau de produits construit à la commande
            $commandData['products']=$products;
            $commandes[] = $this->hydrator->hydrate($commandData, clone $entity);


        }

        return $commandes;
    }
}