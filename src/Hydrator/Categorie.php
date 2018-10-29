<?php
/**
 * Created by PhpStorm.
 * User: olivier
 * Date: 25/10/18
 * Time: 22:55
 */

namespace Hydrator;


class Categorie
{

    public function extract(\Entity\Categorie $object): array
    {
        $data = [];
        if ($object->getId()) {
            $data['id_cat'] = $object->getId();
        }

        if ($object->getName()) {
            $data['nom_cat'] = $object->getName();
        }

        return $data;
    }

    public function hydrate(array $data, \Entity\Categorie $emptyEntity): \Entity\Categorie
    {
        return $emptyEntity
            ->setId($data['id_cat'] ?? null)
            ->setName($data['nom_cat'] ?? null);
    }
}