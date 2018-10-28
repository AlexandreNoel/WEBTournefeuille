<?php

namespace Hydrator;


class Restaurant
{
    public function extract(\Entity\Restaurant $object): array
    {
        $data = [];
        if ($object->getId()) {
            $data['id_resto'] = $object->getId();
        }

        if ($object->getName()) {
            $data['nom_resto'] = $object->getName();
        }

        if ($object->getDescription()) {
            $data['descr_resto'] = $object->getDescription();
        }

        if ($object->getAddress()) {
            $data['addr_resto'] = $object->getAddress();
        }

        if ($object->getZipCode()) {
            $data['cp_resto'] = $object->getZipCode();
        }

        if ($object->getCity()) {
            $data['city_resto'] = $object->getCity();
        }

        if ($object->getPhoneNumber()) {
            $data['tel_resto'] = $object->getPhoneNumber();
        }

        if ($object->getUrl()) {
            $data['website_resto'] = $object->getUrl();
        }

        if ($object->getThumbnail()){
            $data['thumbnail'] = $object->getThumbnail();
        }

        $data['isdeleted'] = $object -> isDeleted() ? 'TRUE' : 'FALSE';

        return $data;
    }

    public function hydrate(array $data, \Entity\Restaurant $emptyEntity): \Entity\Restaurant
    {
        return $emptyEntity
            ->setId($data['id_resto'] ?? null)
            ->setName($data['nom_resto'] ?? null)
            ->setDescription($data['descr_resto'] ?? null)
            ->setAddress($data['addr_resto'] ?? null)
            ->setZipCode($data['cp_resto'] ?? null)
            ->setCity($data['city_resto'] ?? null)
            ->setPhoneNumber($data['tel_resto'] ?? null)
            ->setUrl($data['website_resto'] ?? null)
            ->setThumbnail($data['thumbnail'] ?? null)
            ->setIsDeleted($data['isdeleted'] ?? null);
    }

}