<?php

namespace Article\Hydrator;
/**
 * Class Article
 * @package Article\Hydrator
 */
class Article{
    public function extract(\Article\Entity\Article $object): array
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
    public function hydrate(array $data, \Article\Entity\Article $emptyEntity): \Article\Entity\Article
    {
        return $emptyEntity
            ->setId($data['idannonce'] ?? null)
            ->setTitre($data['titre'] ?? null)
            ->setContenu($data['contenu'] ?? null)
            ->setIdAuteur($data['idauteur'] ?? null);
    }
}
?>
