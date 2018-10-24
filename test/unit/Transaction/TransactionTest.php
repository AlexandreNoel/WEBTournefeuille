<?php
namespace Transaction;

use PHPUnit\Framework\TestCase;
use Transaction\Entity\Transaction;

class NewsTest extends TestCase
{

    /**
     * @test
     */
    public function test()
    {
        $transac = new Transaction();
        $transac->setId(5);

        self::assertSame(5, $transac->getId());
    }

}