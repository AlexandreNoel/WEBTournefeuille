<?php

namespace News\Hydrator;
/**
 * Class News
 * @package News\Hydrator
 */
class News{
    public function extract(\News\Entity\News $object): array
    {
        $data = [];
        if ($object->getId()) {
            $data['idannonce'] = $object->getId();
        }
        if ($object->getTitle()) {
            $data['titre'] = $object->getTitle();
        }
        if ($object->getContenu()) {
            $data['contenu'] = $object->getContenu();
        }
        if ($object->getIdauteur()) {
            $data['idauteur'] = $object->getIdauteur();
        }
        if ($object->getIdauteur()) {
            $data['idauteur'] = $object->getIdauteur();
        }
        if ($object->getDateCreation()) {
            $data['dateCreation'] = $object->getDateCreation();
        }
        return $data;
    }
    public function hydrate(array $data, \News\Entity\News $emptyEntity): \News\Entity\News
    {
        return $emptyEntity
            ->setId($data['idannonce'] ?? null)
            ->setTitle($data['titre'] ?? null)
            ->setContenu($data['contenu'] ?? null)
            ->setIdAuteur($data['idauteur'] ?? null)
            ->setDateCreation($data['dateCreation'] ?? null);
    }
}
?>
