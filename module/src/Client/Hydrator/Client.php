<?php

namespace Client\Hydrator;
/**
 * Class Client
 * @package Client\Hydrator
 */
class Client{
    public function extract(\Client\Entity\Client $object): array
    {
        $data = [];
        if ($object->getId()) {
            $data['idclient'] = $object->getId();
        }
        if ($object->getFirstname()) {
            $data['firstname'] = $object->getFirstname();
        }
        if ($object->getNickname()) {
            $data['nickname'] = $object->getNickname();
        }
        if ($object->getLastname()) {
            $data['lastname'] = $object->getLastname();
        }
        if ($object->getSolde()) {
            $data['solde'] = $object->getSolde();
        }
<<<<<<< HEAD
        if ($object->getRole()) {
            $data['idrole'] = $object->getRole();
        }

=======
        if ($object->getCodebarmen()) {
            $data['codebarmen'] = $object->getSolde();
        }
>>>>>>> e4d5b5b6e7ad5135796919d8ca131f4d5c5693da
        return $data;
    }
    public function hydrate(array $data, \Client\Entity\Client $emptyEntity): \Client\Entity\Client
    {
        return $emptyEntity
            ->setId($data['idutilisateur'] ?? null)
            ->setNickname($data['pseudo'] ?? null)
            ->setLastname($data['nom'] ?? null)
            ->setFirstname($data['prenom'] ?? null)
            ->setSolde($data['solde'] ?? null)
<<<<<<< HEAD
            ->setIdrole($date['idrole'] ?? null);
=======
            ->setCodebarmen($data['codebarmen'] ?? null);
>>>>>>> e4d5b5b6e7ad5135796919d8ca131f4d5c5693da
    }
}
?>
