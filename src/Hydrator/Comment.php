<?php

namespace Hydrator;


class Comment
{
    public function extract(\Entity\Comment $object): array
    {
        $data = [];
        if ($object->getIdComment()) {
            $data['id_comment'] = $object->getIdComment();
        }

        if ($object->getIdUser()) {
            $data['id_user_persons'] = $object->getIdUser();
        }

        if ($object->getIdResto()) {
            $data['id_resto_restos'] = $object->getIdResto();
        }

        if ($object->getText()) {
            $data['text_comment'] = $object->getText();
        }

        if ($object->getDate()) {
            $data['date_comment'] = $object->getDate()->format(\DateTime::ATOM);
        }

        if ($object->getScore()) {
            $data['note_resto'] = $object->getScore();
        }

        return $data;
    }

    public function hydrate(array $data, \Entity\Comment $emptyEntity): \Entity\Comment
    {
        return $emptyEntity
            ->setIdComment($data['id_comment'] ?? null)
            ->setIdResto($data['id_resto_restos'] ?? null)
            ->setIdUser($data['id_user_persons'] ?? null)
            ->setText( $data['text_comment'] ?? null)
            ->setDate($data['date_comment'] ? new \DateTime($data['date_comment']): null)
            ->setScore( $data['note_resto'] ?? null);
    }
}