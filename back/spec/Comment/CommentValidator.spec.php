<?php

describe('CommentValidator', function() {
    beforeEach(function() {
        $this->commentValidator = new \Comment\CommentValidator();
    });

    it('should return true if a user is valid', function() {
        $comment = (new \Comment\Comment())
            ->setIdUser(1)
            ->setIdBar(2)
            ->setContent('content');

        expect($this->commentValidator->validate($comment))->toBeTruthy();
    });

    it('should return false if a user is not valid', function() {
        expect($this->commentValidator->validate(null))->toBeFalsy();
        expect($this->commentValidator->validate(new stdClass()))->toBeFalsy();
    });
});
