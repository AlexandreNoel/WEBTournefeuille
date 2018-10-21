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
                'libelle' => "tagada",
                'prix' => 2,
                'quantitestock' => 2,
                'reduction' => 0,
                'idcategorie' => 1,
            ],
            new \Product\Entity\Product()
        );
        $productRepository->create($newProduct);
        $monproduct=$productRepository->findById(16);
        $product = new Product();
        $product->setQuantity(4);
        var_dump($monproduct);

        self::assertSame(4, $product->getQuantity());
    }

}