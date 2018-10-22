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
            ->setFirstname($data['Prenom_User'] ?? null)
            ->setLastname($data['Nom_User'] ?? null)
            ->setPassword($data['Secret_User'] ?? null)
            ->setMailAdress($data['mail_User'] ?? null)
            ->setIsAdmin($data['isAdmin']  ?? null)
            ->setPromo($data['Promo_User'] ?? null);
    }
}