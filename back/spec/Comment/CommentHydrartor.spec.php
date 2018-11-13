<?php

describe('CommentHydrator', function() {
    beforeEach(function() {
        $this->commentHydrator = new \Comment\CommentHydrator();
    });

    it('should extract a list of comments', function() {
        $comments = [
            (new \Comment\Comment())
                ->setId(1)
                ->setIdBar(3)
                ->setIdUser(9)
                ->setContent('This is a comment')
                ->setDate('2018-01-01')
                ->setPseudo('Bob')
                ->setNameBar('Un bar')
        ];

        expect($this->commentHydrator->extractAll($comments))->toBe([
            [
                "id" => 1,
                "idBar" => 3,
                "iduser" => 9,
                "content" => "This is a comment",
                "nameBar" => "Un bar",
                "dateCom" => "2018-01-01",
                "pseudo" => "Bob"
            ]
        ]);
    });
});
