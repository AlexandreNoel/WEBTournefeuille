<?php
namespace Keyword;

describe('KeywordRepository', function() {
    beforeEach(function() {
        $this->pdo = new MockPDO();
        $this->keywordRepository = new KeywordRepository($this->pdo);
    });

    it('should fetch all the keywords', function() {
        $keywords = $this->keywordRepository->fetchAll();

        expect(sizeof($keywords))->toBe(3);
    });

    it('should return false when query fail', function() {
        $this->pdo->failMode();

        expect($this->keywordRepository->fetchAll())->toBeFalsy();
    });
});

class MockPDO {
    private $fail;
    public function failMode() {
        $this->fail = true;
    }
    public function query($query) {
        if ($this->fail) return false;
        return $this;
    }
    public function fetchAll() {
        return [
            (new Keyword())->setId(1)->setName('zen'),
            (new Keyword())->setId(2)->setName('sport'),
            (new Keyword())->setId(3)->setName('danse')
        ];
    }
}
