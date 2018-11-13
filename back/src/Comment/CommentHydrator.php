<?php

namespace Comment;

class CommentHydrator
{
    public function extract(Comment $comment): array
    {
        $data = [];

        if ($comment->getId()) {
            $data['id'] = $comment->getId();
        }
        if ($comment->getIdBar()) {
            $data['idBar'] = $comment->getIdBar();
        }
        if($comment->getIdUser())
        {
            $data['iduser'] = $comment->getIdUser();
        }
        if ($comment->getContent()) {
            $data['content'] = $comment->getContent();
        }
        if ($comment->getNameBar()) {
            $data['nameBar'] = $comment->getNameBar();
        }
        if ($comment->getDate()) {
            $data['dateCom'] = $comment->getDate();
        }
        if ($comment->getPseudo()) {
            $data['pseudo'] = $comment->getPseudo();
        }
        return $data;
    }

    public function extractAll($comments)
    {
        $data = [];
        foreach ($comments as $comment) {
            $data[] = $this->extract($comment);
        }
        return $data;
    }
}

