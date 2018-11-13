<?php

namespace User;

class UserHydrator
{
    public function extract(User $user): array
    {
        $data = [];

        if ($user->getId()) {
            $data['id'] = $user->getId();
        }
        if ($user->getEmail()) {
            $data['email'] = $user->getEmail();
        }
        if ($user->getHash()) {
            $data['hash'] = $user->getHash();
        }
        if ($user->getPseudo()) {
            $data['pseudo'] = $user->getPseudo();
        }
        if ($user->getRole()) {
            $data['role'] = $user->getRole();
        }
        if (count($user->getkeywords()) > 0) {
            $keywordHydrator = new \Keyword\KeywordHydrator();
            $data['keywords'] = $keywordHydrator->extractAll($user->getKeywords());
        }

        return $data;
    }

    public function extractAll($users)
    {
        $data = [];
        foreach ($users as $user) {
            $data[] = $this->extract($user);
        }
        return $data;
    }
}
