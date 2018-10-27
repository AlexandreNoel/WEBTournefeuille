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
    }/**
     * @test
     */
    public function UpdateTest()
    {
        $repository = new \News\Repository\News();
        $last = $repository->findLastNews();
        $last->setTitle("ceci est un titre modifie par phpunit, merci à plus");
        $repository->update($last);
        $lastupdated=$repository->findById($last->getId());
        self::assertSame("ceci est un titre modifie par phpunit, merci à plus", $lastupdated->getTitle());
        $last->setTitle("Nouvelle Application");
        $repository->update($last);
    }/**
     * @test
     */
    public function FindByIdTest()
    {
        $repository = new \News\Repository\News();
        $last = $repository->findById(1);
        self::assertEquals(1,$last->getId());
        self::assertEquals("Nouvelle Application",$last->getTitle());

    }/**
     * @test
     */
    public function FindLast()
    {
        $repository = new \News\Repository\News();
        $last = $repository->findLast(3);
        self::assertEquals(3,sizeof($last));
        $last = $repository->findLast(2);
        self::assertEquals(2,sizeof($last));
        self::assertInstanceOf('\News\Entity\News',$last[0]);

    }

}