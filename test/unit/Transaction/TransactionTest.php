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
                'datecommande' => '2018-10-27 12:00:00',
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
        self::assertEquals($found->getIdBarmen(), $newTransaction->getIdBarmen());
        self::assertEquals($found->getIdClient(), $newTransaction->getIdClient());
        self::assertEquals($found->getDate(), $newTransaction->getDate());
        self::assertEquals($found->getPrice(), $newTransaction->getPrice());
        $productsBase=$found->getProduct();
        $productsBase->rewind();
        $products->rewind();
        while($productsBase->valid()){
            $productBase=$productsBase->current();
            $product=$products->current();
            $ammountBase=$productsBase->getInfo();
            $ammount=$products->getInfo();
            self::assertEquals($productBase,$product);
            self::assertEquals($ammount,$ammountBase);
            $products->next();
            $productsBase->next();
        }
    }
    /**
     * @test
     */
    public function testFindAll()
    {
        $transacRepository = new \Transaction\Repository\Transaction();
        $transacHydrator = new \Transaction\Hydrator\Transaction();
        $allTransac=$transacRepository->findAll();
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
        $productRepository = new \Product\Repository\Product();
        $transacRepository = new \Transaction\Repository\Transaction();

        $mytransac=$transacRepository->findOneById(1);
        self::assertSame(42.0, $mytransac->getPrice());
        self::assertSame(1, $mytransac->getIdClient());
        self::assertSame(2, $mytransac->getIdBarmen());
    }
    /**
     * @test
     */
    public function testFindByCriteria()
    {
        $transacRepository = new \Transaction\Repository\Transaction();
        $transacHydrator = new \Transaction\Hydrator\Transaction();
        $allTransac=$transacRepository->findByCriteria('idBarmen',2);
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