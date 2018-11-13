<?php
namespace Keyword;

class KeywordHydrator
{
    private function extract(Keyword $keyword)
    {
        $data = [];
        if ($keyword->getId()) {
            $data['id'] = $keyword->getId();
        }
        if ($keyword->getName()) {
            $data['name'] = $keyword->getName();
        }
        return $data;
    }

    public function extractAll($keywords)
    {
        $data = [];
        foreach ($keywords as $keyword) {
            $data[] = $this->extract($keyword);
        }
        return $data;
    }
}
