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
            $data['idutilisateur'] = $object->getId();
        }
        if ($object->getFirstname()) {
            $data['prenom'] = $object->getFirstname();
        }
        if ($object->getNickname()) {
            $data['pseudo'] = $object->getNickname();
        }
        if ($object->getLastname()) {
            $data['nom'] = $object->getLastname();
        }
        if ($object->getSolde()>=0){
            $data['solde'] = $object->getSolde();
        }
        if ($object->getCodebarmen()) {
            $data['codebarmen'] = $object->getCodebarmen();
        }
        return $data;
    }
    public function hydrate(array $data, \Client\Entity\Client $emptyEntity): \Client\Entity\Client
    {
        return $emptyEntity
            ->setId($data['idutilisateur'] ?? 0)
            ->setNickname(strtolower($data['pseudo']) ?? "")
            ->setLastname(strtolower($data['nom']) ?? "")
            ->setFirstname(strtolower($data['prenom']) ?? "")
            ->setSolde($data['solde'] ?? 0)
            ->setCodebarmen($data['codebarmen'] ?? "");
    }
}
?>
