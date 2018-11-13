<?php
namespace User;

describe('UserValidator', function() {
    beforeEach(function() {
        $this->userValidator = new UserValidator();
    });

    it('should return true if the user is valid', function() {
        $validUser = new \stdClass();
        $validUser->pseudo = 'Boby';
        $validUser->email = 'boby@gmail.com';
        $validUser->password = 'boby123';

        expect($this->userValidator->validate($validUser))->toBeTruthy();
    });

    it('should return false if the user is null', function() {
        $invalidUser = null;

        expect($this->userValidator->validate($invalidUser))->toBeFalsy();
    });

    it('should return false if the pseudo is not defined', function() {
        $invalidUser = new \stdClass();
        $invalidUser->email = 'boby@gmail.com';
        $invalidUser->password = 'boby123';

        expect($this->userValidator->validate($invalidUser))->toBeFalsy();
    });

    it('should return false if the email is not defined', function() {
        $invalidUser = new \stdClass();
        $invalidUser->pseudo = 'boby';
        $invalidUser->password = 'boby123';

        expect($this->userValidator->validate($invalidUser))->toBeFalsy();
    });

    it('should return false if the password is not defined', function() {
        $invalidUser = new \stdClass();
        $invalidUser->pseudo = 'boby';
        $invalidUser->email = 'boby@gmail.com';

        expect($this->userValidator->validate($invalidUser))->toBeFalsy();
    });

    it('should return false if the password is lower than 3 chars', function() {
        $invalidUser = new \stdClass();
        $invalidUser->pseudo = 'boby';
        $invalidUser->email = 'boby@gmail.com';
        $invalidUser->password = '12';

        expect($this->userValidator->validate($invalidUser))->toBeFalsy();
    });

    it('should return false if the pseudo is lower than 3 chars', function() {
        $invalidUser = new \stdClass();
        $invalidUser->pseudo = 'bo';
        $invalidUser->email = 'boby@gmail.com';
        $invalidUser->password = 'boby123';

        expect($this->userValidator->validate($invalidUser))->toBeFalsy();
    });

    it('should return false if the email is not valid', function() {
        $invalidUser = new \stdClass();
        $invalidUser->pseudo = 'boby';
        $invalidUser->email = 'boby.gmail.com';
        $invalidUser->password = 'boby123';

        expect($this->userValidator->validate($invalidUser))->toBeFalsy();
    });
});
