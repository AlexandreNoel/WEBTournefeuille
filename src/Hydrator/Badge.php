<?php


namespace Hydrator;


class Badge
{

    public function extract(\Entity\Badge $object) : array
    {
        $data = [];
        if ($object->getId()) {
            $data['id_badge'] = $object->getId();
        }

        if ($object->getName()) {
            $data['nom_badge'] = $object->getName();
        }

        if ($object->getLink()) {
            $data['badge_link'] = $object->getLink();
        }

        return $data;
    }

    public function hydrate(array $data, \Entity\Badge $emptyEntity) : \Entity\Badge
    {
        return $emptyEntity
            ->setId($data['id_badge'] ?? null)
            ->setName($data['nom_badge'] ?? null)
            ->setLink($data['badge_link'] ?? null);
    }
}