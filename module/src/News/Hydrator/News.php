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
        if ($object->getDateCreation()){
            $data['datecreation'] = $object->getDateCreation()->format(\DateTime::ATOM);
        }

        return $data;
    }
    public function hydrate(array $data, \News\Entity\News $emptyEntity): \News\Entity\News
    {
        if (array_key_exists("datecreation", $data)){
            $time = new \DateTime($data["datecreation"]);
        } else {
            $time = new \DateTime("now");
        }
        return $emptyEntity
            ->setId($data['idannonce'] ?? null)
            ->setTitle($data['titre'] ?? null)
            ->setContenu($data['contenu'] ?? null)
            ->setIdAuteur($data['idauteur'] ?? null)
            ->setDateCreation($time);
    }
}
?>
