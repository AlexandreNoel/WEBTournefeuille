<?php
namespace News;

use News\Repository\News;
use PHPUnit\Framework\TestCase;

class NewsTest extends TestCase
{

    /**
     * @test
     */
    public function test()
    {
        $news = new \News\Entity\News();
        $news->setTitle(5);
        self::assertSame(5, $news->getTitle());
    }

    /**
     * @test
     */
    public function CreateTest()
    {
        $news = new \News\Entity\News();
        $repository = new \News\Repository\News();
        $news->setContenu("Test PHPUNIT")
            ->setIdauteur("1")
            ->setTitle("PHP UNIT");
        $repository->create($news);
        $last = $repository->findLastNews();
        self::assertSame($last->getTitle(), $news->getTitle());
        self::assertSame($last->getContenu(), $news->getContenu());
        self::assertEquals($last->getIdauteur(), $news->getIdauteur());
    }

    /**
     * @test
     */
    public function DeleteTest()
    {
        $repository = new \News\Repository\News();
        $last = $repository->findLastNews();
        $repository->delete($last->getId());
        $anotherlast = $repository->findLastNews();
        self::assertNotEquals($last, $anotherlast);
    }

}