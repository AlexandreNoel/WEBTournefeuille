<?php
namespace Product;

use PHPUnit\Framework\TestCase;
use Product\Entity\Product;

//use Product\Entity\Product;

class ProductTest extends TestCase
{
    /**
     * @test
     */
    public function test()
    {
        $product = new Product();
        $product->setQuantity(4);
        self::assertSame(4, $product->getQuantity());
    }
}