<?php
namespace News;

use PHPUnit\Framework\TestCase;
use News\Entity\News;

class NewsTest extends TestCase
{

    /**
     * @test
     */
    public function test()
    {
        $news = new News();
        $news->setTitle(5);

        self::assertSame(5, $news->getTitle());
    }

}