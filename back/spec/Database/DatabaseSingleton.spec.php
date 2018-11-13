<?php

describe('DatabaseSingleton', function() {
    it('should create a new PDO with env variables', function() {
        $pdo = \Database\DatabaseSingleton::getInstance();

        expect($pdo)->toBeAnInstanceOf('PDO');
        expect($pdo)->toBe(\Database\DatabaseSingleton::getInstance());
    });
});
