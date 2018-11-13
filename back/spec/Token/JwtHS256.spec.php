<?php

describe('JwtHS256', function() {
    beforeEach(function() {
        $this->secret = 'secret';
        $this->token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjp7ImlkIjoxLCJyb2xlIjoiQURNSU4ifSwiZXhwIjoxNTI5NDk1OTU2fQ.2lsas1TCpa87MRPIQFz6cMbxp8rhUwjj9YfYS6zhVdM';
    });

    it('should generate a token with hmac sha256', function() {
        $user = (new \User\User)
            ->setId(1)
            ->setRole('ADMIN');
        $token = \Token\JwtHS256::generate($user, $this->secret, 1529495956);

        expect($token)->toBe($this->token);
    });

    it('should extract the user id', function() {
        allow('time')->toBeCalled()->andReturn(123);

        $user = \Token\JwtHS256::validate($this->token, $this->secret);

        expect($user->id)->toBe(1);
        expect($user->role)->toBe('ADMIN');
    });


    it('should throw an exception when token expired', function() {
        allow('time')->toBeCalled()->andReturn(1529495956 + 1);
        $closure = function() {
            \Token\JwtHS256::validate($this->token, $this->secret);
        };

        expect($closure)->toThrow(new \Exception('Token has expired'));
    });

    it('should throw an exception when token is corrupted', function() {
        allow('time')->toBeCalled()->andReturn(123);
        $closure = function() {
            \Token\JwtHS256::validate('corrupted.token.GwejAIAJ-XFFNhh_8Z2wVlAMbglHoimgGtG8LGc_Dvs', $this->secret);
        };

        expect($closure)->toThrow(new \Exception('Token is corrupted'));
    });
});
