<?php
namespace User;

describe('UserRepository', function() {
    it('should fetch all users', function() {
        $userRepository = new UserRepository(new MockPDO());

        $user = $userRepository->fetchByLogin('email');

        expect($user->getId())->toBe(1);
        expect($user->getEmail())->toBe('bob.marley@gmail.com');
        expect($user->getHash())->toBe('HASH');
        expect($user->getPseudo())->toBe('boby');
        expect($user->getRole())->toBe('USER');
    });
});

class MockPDO {

    public function prepare() {
        return $this;
    }

    public function setFetchMode() {}

    public function bindParam() {}

    public function query() {
        return $this;
    }

    public function execute() {
        return true;
    }

    public function fetch() {
        return (new User())
            ->setId(1)
            ->setEmail('bob.marley@gmail.com')
            ->setHash('HASH')
            ->setPseudo('boby')
            ->setRole('USER');
    }
}
