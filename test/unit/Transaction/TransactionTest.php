<?php
namespace Transaction;

use PHPUnit\Framework\TestCase;
use Transaction\Entity\Transaction;

class TransactionTest extends TestCase
{

    /**
     * @test
     */
    public function testCreate()
    {
        $transac = new Transaction();
        $productHydrator = new \Product\Hydrator\Product();
        $transacHydrator = new \Transaction\Hydrator\Transaction();
        $productRepository = new \Product\Repository\Product();
        $clientRepository = new \Client\Repository\Client();
        $transacRepository = new \Transaction\Repository\Transaction();
//        new \DateTime()->format('Y-m-d H:i:s');
        $client=$clientRepository->findOneById(1);
        $barmen=$clientRepository->findOneById(2);
        $product=$productRepository->findById(1);
        $product2=$productRepository->findById(2);

        $products = new \SplObjectStorage();
        $products->attach($product,4);
        $products->attach($product2,4);
        $madate = new \DateTime();
        $madate->format('Y\-m\-d\ h:i:s');
//        $madate=$madate->getTimestamp();
        $newTransaction = $transacHydrator->hydrate(
            [
                'datecommande' => $madate,
                'prixtotal' => 2,
                'products' =>$products,
                'idutilisateur' => $client,
                'idbarmen' => $barmen
            ],
            new \Transaction\Entity\Transaction()
        );
        $id=$transacRepository->create($newTransaction);
        $found=$transacRepository->findOneById($id);
        self::assertSame($id, $found->getId());
    }
    /**
     * @test
     */
    public function testPrice()
    {
        $transac = new Transaction();
        $productHydrator = new \Product\Hydrator\Product();
        $productRepository = new \Product\Repository\Product();
        $product=$productRepository->findById(1);
        $product2=$productRepository->findById(2);
        $products = new \SplObjectStorage();
        $products->attach($product,4);
        $products->attach($product2,4);
        $transac = new Transaction();
        $transac->setProduct($products);
        $transac->setId(5);

        self::assertSame(4.0, $transac->getPrice());
    }

}