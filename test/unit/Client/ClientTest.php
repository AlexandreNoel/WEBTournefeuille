<?php
namespace Client;

use Adapter\DatabaseFactory;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     * @test
     */

    public function retrieveByIdAndNickname()
    {
        $dbfactory = new DatabaseFactory();
        $dbconnector = $dbfactory->getDbAdapter();
        $hydrator = new \Client\Hydrator\Client();
        $userRepository = new \Client\Repository\Client($dbconnector);
        $gefclic = $hydrator->hydrate(
            [
                'idutilisateur' => 1,
                'prenom' => "Benoit",
                'pseudo' => "Gefclic",
                'nom' => "SCHOLL",
                'solde' => 25
            ],
            new \Client\Entity\Client()
        );
        $retrieved = $userRepository->findOneById(1);
        $retrieved2 = $userRepository->findOneByNickname('gefclic');
        self::assertSame($gefclic->getFirstname(), $retrieved2->getFirstname());
        self::assertSame($gefclic->getFirstname(), $retrieved->getFirstname());
        self::assertSame($gefclic->getLastname(), $retrieved->getLastname());
        self::assertSame($gefclic->getSolde(), $retrieved->getSolde());
        self::assertSame($gefclic->getId(), $retrieved->getId());
    }

    /**
     * @test
     */
    public function createBarmen(){
        $dbfactory = new DatabaseFactory();
        $dbconnector = $dbfactory->getDbAdapter();
        $hydrator = new \Client\Hydrator\Client();
        $userRepository = new \Client\Repository\Client($dbconnector);
        $moi = $hydrator->hydrate(
            [
                'prenom' => "Le",
                'pseudo' => "Swagozaure",
                'nom' => "Phantome",
                'solde' => 25,
                'idrole' => 2

            ],
            new \Client\Entity\Client()
        );
        $userRepository->create($moi);
        $moiEnBase=$userRepository->findOneByNickname('Swagozaure');
        self::assertSame($moiEnBase->getNickname(), $moi->getNickname());



    }
    /**
     * @test
     */
    public function grantBarmen(){
        $dbfactory = new DatabaseFactory();
        $dbconnector = $dbfactory->getDbAdapter();
        $hydrator = new \Client\Hydrator\Client();
        $userRepository = new \Client\Repository\Client($dbconnector);

        $moiEnBase=$userRepository->findOneByNickname('Swagozaure');
        $moiEnBase->setCodebarmen("MonPremierBarmen");
        $userRepository->grantBarmen($moiEnBase);

        $moiEnBase=$userRepository->findOneByNickname('Swagozaure');
        self::assertSame($moiEnBase->getCodebarmen(), "MonPremierBarmen");

        $userRepository->revokeBarmen($moiEnBase);
        $moiEnBase=$userRepository->findOneByNickname('Swagozaure');
        self::assertSame($moiEnBase->getCodebarmen(), null);


    }
    /**
     * @test
     */
    public function removeUser(){
        $dbfactory = new DatabaseFactory();
        $dbconnector = $dbfactory->getDbAdapter();
        $hydrator = new \Client\Hydrator\Client();
        $userRepository = new \Client\Repository\Client($dbconnector);
        $moiEnBase=$userRepository->findOneByNickname('Swagozaure');
        self::assertSame($moiEnBase->getNickname(), 'swagozaure');
        $userRepository->remove($moiEnBase);
        $moiEnBase=$userRepository->findOneByNickname('Swagozaure');
        self::assertSame($moiEnBase, null);

   }
    /**
     * @test
     */
    public function retrieveByArise(){
        $dbfactory = new DatabaseFactory();
        $dbconnector = $dbfactory->getDbAdapter();
        $userRepository = new \Client\Repository\Client($dbconnector);

        $name='Antoine';
        $nickname='Chap';
        $lastname='Chapusot';
        $retrieved = $userRepository->findByAriseData($lastname,$name,$nickname);
        self::assertSame($retrieved->getNickname(), strtolower($nickname));

    }
    public function testBarmen(){
        $dbfactory = new DatabaseFactory();
        $dbconnector = $dbfactory->getDbAdapter();
        $hydrator = new \Client\Hydrator\Client();
        $userRepository = new \Client\Repository\Client($dbconnector);
        $chap = $hydrator->hydrate(
            [
                'idutilisateur' => 2,
                'prenom' => "Antoine",
                'pseudo' => "Chap",
                'nom' => "CHAPUZOT",
                'solde' => 25,
                'codebarmen' => 'LaGuinessCestLaBase'
            ],
            new \Client\Entity\Client()
        );
        $retrieved = $userRepository->findOneById(2);
        self::assertSame($chap->getFirstname(), $retrieved->getFirstname());
        self::assertSame($chap->getCodebarmen(), $retrieved->getCodebarmen());

    }
}