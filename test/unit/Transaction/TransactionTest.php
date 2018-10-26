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
        $productHydrator = new \Product\Hydrator\Product();
        $transacHydrator = new \Transaction\Hydrator\Transaction();
        $productRepository = new \Product\Repository\Product();
        $transacRepository = new \Transaction\Repository\Transaction();

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
                'datecommande' => $madate->getTimestamp(),
                'prixtotal' => 2,
                'products' =>$products,
                'idutilisateur' => 3,
                'idbarmen' => 2
            ],
            new \Transaction\Entity\Transaction()
        );
        $id=$transacRepository->create($newTransaction);
        $found=$transacRepository->findOneById($id);
        self::assertSame(intval($id), $found->getId());
    }
    /**
     * @test
     */
    public function testFindAll()
    {
        $transacRepository = new \Transaction\Repository\Transaction();
        $transacHydrator = new \Transaction\Hydrator\Transaction();
        $allTransac=$transacRepository->findAll();
        var_dump($allTransac);
        $firstelem=$allTransac[0];
        $test= $firstelem;
        self::assertGreaterThanOrEqual(0,sizeof($allTransac));
        self::assertEquals(1,$test->getIdClient());
        self::assertEquals(2,$test->getIdBarmen());
        self::assertLessThanOrEqual(new \DateTime(),$firstelem->getDate());
    }
    /**
     * @test
     */
    public function testFindById()
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