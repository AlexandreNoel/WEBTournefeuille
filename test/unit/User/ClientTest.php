<?php
namespace Client;

use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     * @test
     */
    public function ageWhenBirthdayInThePast()
    {
        $user = new Client();
        $user->setBirthday(new \DateTime('-10 years'));
        self::assertSame(10, $user->getAge());
    }

    /**
     * @test
     */
    public function ageWhenBirthdayNow()
    {
        $user = new Client();
        $user->setBirthday(new \DateTime());
        self::assertSame(0, $user->getAge());
    }

    /**
     * @test
     * @expectedException \OutOfRangeException
     */
    public function ageWhenBirthdayInTheFuture()
    {
        $user = new Client();
        $user->setBirthday(new \DateTime('+10 years'));
        $user->getAge();
    }
}