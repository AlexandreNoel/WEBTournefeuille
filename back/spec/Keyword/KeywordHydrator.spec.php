<?php
namespace Keyword;

describe('KeywordHydrator', function() {
    beforeEach(function() {
        $this->keywordHydrator = new KeywordHydrator();
    });

    it('should extract a list of keywords', function() {
        $keywords = [
            (new Keyword())->setId(1)->setName('bob'),
            (new Keyword())->setId(2)->setName('paul')
        ];

        expect($this->keywordHydrator->extractAll($keywords))->toBe([
            [ 'id' => 1, 'name' => 'bob' ],
            [ 'id' => 2, 'name' => 'paul' ]
        ]);
    });
});
