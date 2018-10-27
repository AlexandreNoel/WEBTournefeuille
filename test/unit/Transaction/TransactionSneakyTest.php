<?php
namespace Transaction;

use PHPUnit\Framework\TestCase;
use Transaction\Entity\Transaction;

class TransactionSneakyTest extends TestCase
{

    /**
     * @test
     */

    /**
     * @test
     */
    public function testFindById()
    {
        $transac = new Transaction();
        $productRepository = new \Product\Repository\Product();
        $transacRepository = new \Transaction\Repository\Transaction();

        $mytransac=$transacRepository->findOneById(-1);
        self::assertSame(null, $mytransac);
    }

}