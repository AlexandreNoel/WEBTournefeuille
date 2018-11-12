<?php
namespace Client;

use Adapter\DatabaseFactory;
use PHPUnit\Framework\TestCase;
use Webmozart\Assert\Assert;

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
                'nom' => "SCHOLL"
            ],
            new \Client\Entity\Client()
        );
        $retrieved = $userRepository->findOneById(1);
        $retrieved2 = $userRepository->findOneByNickname('gefclic');
        self::assertSame($gefclic->getFirstname(), $retrieved2->getFirstname());
        self::assertSame($gefclic->getFirstname(), $retrieved->getFirstname());
        self::assertSame($gefclic->getLastname(), $retrieved->getLastname());
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
        self::assertSame($moiEnBase->getCodebarmen(), '');


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
                'codebarmen' => hash('sha256','[BARD-BARMEN]admin')
            ],
            new \Client\Entity\Client()
        );
        $retrieved = $userRepository->findOneById(2);
        self::assertSame($chap->getFirstname(), $retrieved->getFirstname());
        self::assertSame(strtoupper($chap->getCodebarmen()), strtoupper($retrieved->getCodebarmen()));

    }
    public function testMoney(){
        $dbfactory = new DatabaseFactory();
        $dbconnector = $dbfactory->getDbAdapter();
        $hydrator = new \Client\Hydrator\Client();
        $userRepository = new \Client\Repository\Client($dbconnector);
        $userRepository->giveMoney(1,100,2);
        $retrieved = $userRepository->findOneById(1);
        self::assertGreaterThanOrEqual(100,$retrieved->getSolde() );

        $userRepository->giveMoney(1,-100,2);
    }
    public function testUpdate(){
        $dbfactory = new DatabaseFactory();
        $dbconnector = $dbfactory->getDbAdapter();
        $hydrator = new \Client\Hydrator\Client();
        $userRepository = new \Client\Repository\Client($dbconnector);
        $retrieved = $userRepository->findOneById(1);
        self::assertSame("benoit",$retrieved->getFirstname());
        $retrieved->setFirstname("Ne fait rien pour le projet");
        $userRepository->update($retrieved);
        $retrieved = $userRepository->findOneById(1);
        self::assertSame("ne fait rien pour le projet",$retrieved->getFirstname() );
        $retrieved->setFirstname("benoit");
        $userRepository->update($retrieved);

    }
    public function testCredit(){
        $dbfactory = new DatabaseFactory();
        $dbconnector = $dbfactory->getDbAdapter();
        $userRepository = new \Client\Repository\Client($dbconnector);
        $retrieved = $userRepository->findOneById(1);
        $money=$retrieved->getSolde();
        $userRepository->giveMoney($retrieved->getId(),10,2);
        $retrieved2 = $userRepository->findOneById(1);
        self::assertEquals($retrieved->getSolde()+10,$retrieved2->getSolde());
        $userRepository->giveMoney($retrieved->getId(),-10,2);


    }
}