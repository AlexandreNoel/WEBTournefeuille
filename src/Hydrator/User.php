<?php

namespace Hydrator;


class User
{


    public function extract(\Entity\User $object): array
    {
        $data = [];
        if ($object->getId()) {
            $data['id_user'] = $object->getId();
        }

        if ($object->getFirstname()) {
            $data['prenom_user'] = $object->getFirstname();
        }

        if ($object->getLastname()) {
            $data['nom_user'] = $object->getLastname();
        }

        $data['isadmin'] = $object -> isAdmin() ? 'TRUE' : 'FALSE';

        if ($object->getPromo()) {
            $data['promo_user'] = $object->getPromo();
        }

        if ($object->getMailAdress()) {
            $data['mail_user'] = $object->getMailAdress();
        }
        if ($object->getPassword()) {
            $data['secret_user'] = $object->getPassword();
        }

        return $data;
    }

    public function hydrate(array $data, \Entity\User $emptyEntity): \Entity\User
    {
        return $emptyEntity
            ->setId($data['id_user'] ?? null)
            ->setFirstname($data['prenom_user'] ?? null)
            ->setLastname($data['nom_user'] ?? null)
            ->setPassword($data['secret_user'] ?? null)
            ->setMailAdress($data['mail_user'] ?? null)
            ->setIsAdmin($data['isadmin']  ?? null)
            ->setPromo($data['promo_user'] ?? null);
    }
}