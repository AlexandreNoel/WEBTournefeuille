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
    /**
     * @test
     */
    public function testCreate()
    {
        $productHydrator = new \Product\Hydrator\Product();
        $productRepository = new \Product\Repository\Product();
        $newProduct = $productHydrator->hydrate(
            [
                'name' => "tagada",
                'price' => 2,
                'quantity' => 2,
                'reduction' => 0,
                'idfamilly' => 1,
            ],
            new \Product\Entity\Product()
        );
        $productRepository->create($newProduct);
        $product = new Product();
        $product->setQuantity(4);

        self::assertSame(4, $product->getQuantity());
    }

}