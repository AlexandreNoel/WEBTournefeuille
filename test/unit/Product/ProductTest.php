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
    public function testCreateAndFind()
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
                'estdisponible' => 1,
            ],
            new \Product\Entity\Product()
        );
        $id=$productRepository->create($newProduct);
        $monproduct=$productRepository->findByName("tagada");
        $monproduct2=$productRepository->findById($id);

        self::assertSame(2, $monproduct->getReduction());
        self::assertEquals($monproduct, $monproduct2);
    }

    /**
     * @test
     */
    public function testUpdate(){


        $productHydrator = new \Product\Hydrator\Product();
        $productRepository = new \Product\Repository\Product();
        $newProduct = $productHydrator->hydrate(
            [
                'libelle' => 'tagada',
                'prix' => 1,
                'quantitestock' => 1,
                'reduction' => 2,
                'idcategorie' => 1,
                'estdisponible' => 1,
            ],
            new \Product\Entity\Product()
        );
        $id=$productRepository->create($newProduct);
        self::assertSame(1, $newProduct->getQuantity());
        self::assertSame(2, $newProduct->getReduction());
        $newProduct->setId($id);
        $newProduct->addQuantity(20);
        $newProduct->setReduction(20);
        $productRepository->update($newProduct);

        self::assertSame(21, $newProduct->getQuantity());
        self::assertSame(20, $newProduct->getReduction());
        $monproduct=$productRepository->findByName("tagada");

        self::assertSame(21, $monproduct->getQuantity());
        self::assertSame(20, $monproduct->getReduction());

    }

    /**
     * @test
     */
    public function testDelete()
    {
        $productRepository = new \Product\Repository\Product();
        $coca = $productRepository->getMostSelled(1)[0];
       $productRepository->deleteByName("tagada");

        self::assertEquals(1,$coca['idproduit']);
        self::assertGreaterThanOrEqual(150,$coca['quantite']);    }

}