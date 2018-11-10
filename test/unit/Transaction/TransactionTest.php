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
        $clientRepository = new \Client\Repository\Client();

        $product=$productRepository->findById(4);
        $product2=$productRepository->findById(3);

        $products = new \SplObjectStorage();
        $product->removeQuantity(1);
        $products->attach($product,1);
        $product2->removeQuantity(3);
        $products->attach($product2,3);
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
        try{
            $id=$transacRepository->create($newTransaction);

        } catch (\Exception $error) {
            echo "Catch " . $error->getMessage();

        }
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
        $clientRepository->giveMoney(3,2,2);
        try{

            $productRepository->modifyStock($product->getId(), 1);
            $productRepository->modifyStock($product2->getId(), 3);
        }
        catch(\Exception $error) {
            echo "Catch " . $error->getMessage();
        }


    }

    /**
     * @test
     */
    public function testExceptionSolde(){
        $transacHydrator = new \Transaction\Hydrator\Transaction();
        $productRepository = new \Product\Repository\Product();
        $transacRepository = new \Transaction\Repository\Transaction();
        $clientRepository = new \Client\Repository\Client();
        $user=$clientRepository->findOneById(3);
        $user->setSolde(0);
        $clientRepository->update($user);
        $product=$productRepository->findById(1);

        $products = new \SplObjectStorage();
        $products->attach($product,1);
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
        try{
            $id=$transacRepository->create($newTransaction);
        } catch (\Exception $error) {
            $craftederror = new \Exception("Solde client trop faible");
            $user->setSolde(25);
            $clientRepository->update($user);
            try{

                $productRepository->modifyStock($product->getId(), 1);
            }
            catch(\Exception $error) {
                echo "Catch " . $error->getMessage();
            }

            self::assertEquals($error, $craftederror);
        }
    }

    /**
     * @test
     */
    public function testClientDebiter()
    {
        $transacHydrator = new \Transaction\Hydrator\Transaction();
        $productRepository = new \Product\Repository\Product();
        $transacRepository = new \Transaction\Repository\Transaction();
        $clientRepository = new \Client\Repository\Client();

        $product=$productRepository->findById(3);
        $product2=$productRepository->findById(1);

        $thuneclient = $clientRepository->findOneById(3)->getSolde();
        $products = new \SplObjectStorage();
        $products->attach($product,1);
        $products->attach($product2,1);
        $madate = new \DateTime();
        $madate->format('Y\-m\-d\ h:i:s');
        $newTransaction = $transacHydrator->hydrate(
            [
                'datecommande' => '2018-10-27 12:00:00',
                'products' =>$products,
                'idutilisateur' => 3,
                'idbarmen' => 2
            ],
            new \Transaction\Entity\Transaction()
        );
        try{
            $id=$transacRepository->create($newTransaction);
        } catch (\Exception $error) {
            echo "Catch " . $error->getMessage();
        }
        $prixcommande = $newTransaction->getPrice();
        self::assertEquals($thuneclient - $prixcommande, $clientRepository->findOneById(3)->getSolde());
        try{

            $productRepository->modifyStock($product->getId(), 1);
            $productRepository->modifyStock($product2->getId(), 1);
        }
        catch(\Exception $error) {
            echo "Catch " . $error->getMessage();
        }
        $clientRepository->giveMoney(3,2,1);

    }


    /**
     * @test
     */
//    public function testFindAll()
//    {
//        $transacRepository = new \Transaction\Repository\Transaction();
//        $transacHydrator = new \Transaction\Hydrator\Transaction();
//        $allTransac=$transacRepository->findAll();
//        $firstelem=$allTransac[0];
//        $test= $firstelem;
//        self::assertGreaterThanOrEqual(0,sizeof($allTransac));
//        self::assertGreaterThanOrEqual(1,$test->getIdClient());
//        self::assertLessThanOrEqual(3,$test->getIdClient());
//        self::assertGreaterThanOrEqual(2,$test->getIdBarmen());
//        self::assertLessThanOrEqual(3,$test->getIdBarmen());
//
//        self::assertLessThanOrEqual(new \DateTime(),$firstelem->getDate());
//    }
    /**
     * @test
     */
    public function testFindById()
    {
        $transac = new Transaction();
        $productRepository = new \Product\Repository\Product();
        $transacRepository = new \Transaction\Repository\Transaction();

        $mytransac=$transacRepository->findOneById(1);
        self::assertGreaterThanOrEqual(1.0, $mytransac->getPrice());
        self::assertGreaterThanOrEqual(1,$mytransac->getIdClient());
        self::assertLessThanOrEqual(3,$mytransac->getIdClient());
        self::assertGreaterThanOrEqual(2,$mytransac->getIdBarmen());
        self::assertLessThanOrEqual(3,$mytransac->getIdBarmen());
    }
    /**
     * @test
     */
    public function testFindByCriteria()
    {
        $transacRepository = new \Transaction\Repository\Transaction();
        $transacHydrator = new \Transaction\Hydrator\Transaction();
        $allTransac=$transacRepository->findByCriteria('idBarmen',3);
        $firstelem=$allTransac[0];
        $test= $firstelem;
        self::assertGreaterThanOrEqual(0,sizeof($allTransac));
        self::assertGreaterThanOrEqual(1,$test->getIdClient());
        self::assertLessThanOrEqual(3,$test->getIdClient());
        self::assertGreaterThanOrEqual(2,$test->getIdBarmen());
        self::assertLessThanOrEqual(3,$test->getIdBarmen());
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
    public function testpurge(){
        $productRepository = new \Product\Repository\Product();
        $product = $productRepository->findById(4);
        try{

            $productRepository->modifyStock(1, -1);
            $productRepository->modifyStock(3, -1);
            $productRepository->modifyStock($product->getId(), 1);
        }
        catch(\Exception $error) {
            echo "Catch " . $error->getMessage();
        }
        self::assertLessThanOrEqual($product->getQuantity()+1,$productRepository->findById($product->getId())->getQuantity());


    }

}