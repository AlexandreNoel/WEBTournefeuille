<?php
namespace User;

describe('UserHydrator', function() {
    beforeEach(function() {
        $this->userHydrator = new UserHydrator();
    });

    it('should extract a list of users', function() {
        $users = [
            (new User())
            ->setId(1)
            ->setEmail('bob.marley@gmail.com')
            ->setHash('HASH')
            ->setPseudo('boby')
            ->setRole('USER')
            ->addKeywords([(new \Keyword\Keyword())->setName('toto')->setId(1)]),
            (new User())
            ->setId(2)
            ->setEmail('test@gmail.com')
            ->setHash('HASH2')
            ->setPseudo('boby2')
            ->setRole('ADMIN')
            ->addKeywords([(new \Keyword\Keyword())->setName('bobo')->setId(2)])
        ];

        $data = $this->userHydrator->extractAll($users);

        expect($data)->toEqual([
            [
                'id' => 1,
                'email' => 'bob.marley@gmail.com',
                'hash' => 'HASH',
                'pseudo' => 'boby',
                'role' => 'USER',
                'keywords' => [['id' => 1, 'name' => 'toto']],
            ],
            [
                'id' => 2,
                'email' => 'test@gmail.com',
                'hash' => 'HASH2',
                'pseudo' => 'boby2',
                'role' => 'ADMIN',
                'keywords' => [['id' => 2, 'name' => 'bobo']],
            ]
        ]);
    });
});
