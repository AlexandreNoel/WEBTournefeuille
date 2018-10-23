<?php
namespace Client;

use Adapter\DatabaseFactory;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     * @test
     */

    public function getFirstUser()
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
        $retrieved = $userRepository->findById(1);
        self::assertSame($gefclic->getFirstname(), $retrieved->getFirstname());
        self::assertSame($gefclic->getLastname(), $retrieved->getLastname());
        self::assertSame($gefclic->getSolde(), $retrieved->getSolde());
        self::assertSame($gefclic->getId(), $retrieved->getId());
    }
}