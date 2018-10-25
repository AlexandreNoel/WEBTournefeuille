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
                'libelle' => 'tagada',
                'prix' => 1,
                'quantitestock' => 1,
                'reduction' => 2,
                'idcategorie' => 1,
            ],
            new \Product\Entity\Product()
        );
        $productRepository->create($newProduct);
        $monproduct=$productRepository->findByName("tagada");

        self::assertSame(2, $monproduct->getReduction());
    }

    /**
     * @test
     */
    public function testDelete()
    {
        $productRepository = new \Product\Repository\Product();
        $productRepository->deleteByName('tagada');
        $tagada = $productRepository->findByName('tagada');
        self::assertNull($tagada);

    }

}