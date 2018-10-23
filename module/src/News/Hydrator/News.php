<?php

namespace Annonce\Hydrator;
/**
 * Class Annonce
 * @package Annonce\Hydrator
 */
class Annonce{
    public function extract(\Annonce\Entity\Annonce $object): array
    {
        $data = [];
        if ($object->getId()) {
            $data['idannonce'] = $object->getId();
        }
        if ($object->getTitre()) {
            $data['titre'] = $object->getName();
        }
        if ($object->getContenu()) {
            $data['contenu'] = $object->getContenu();
        }
        if ($object->getIdauteur()) {
            $data['idauteur'] = $object->getIdauteur();
        }
        return $data;
    }
    public function hydrate(array $data, \Annonce\Entity\Annonce $emptyEntity): \Annonce\Entity\Annonce
    {
        return $emptyEntity
            ->setId($data['idannonce'] ?? null)
            ->setTitre($data['titre'] ?? null)
            ->setContenu($data['contenu'] ?? null)
            ->setIdAuteur($data['idauteur'] ?? null);
    }
}
?>
