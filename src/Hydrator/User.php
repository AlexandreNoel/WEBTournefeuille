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

        if ($object->isAdmin() != null) {
            $data['isadmin'] = $object-isAdmin();
        }

        if ($object->getPromo()) {
            $data['promo'] = $object->getPromo();
        }

        if ($object->getMailAdress()) {
            $data['mail'] = $object->getMailAdress();
        }
        if ($object->getPassword()) {
            $data['password'] = $object->getPassword();
        }

        return $data;
    }

    public function hydrate(array $data, \Entity\User $emptyEntity): \Entity\User
    {
        return $emptyEntity
            ->setId($data['id_user'] ?? null)
            ->setFirstname($data['prenom_user'] ?? null)
            ->setLastname($data['nom_user'] ?? null)
            /* todo
             ->setMailAdress($data['mail'] ?? null)
             ->setPassword($data['password'] ?? null)
             */
            ->setIsAdmin($data['isadmin']  ?? null)
            ->setPromo($data['promo'] ?? null);
    }
}