<?php
namespace User;

class UserRepository
{
    private $connection;
    private $keywordRepository;

    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->keywordRepository = new \Keyword\KeywordRepository($connection);
    }

    public function fetchByLogin(string $login)
    {
        $stmt = $this->connection->prepare('SELECT id, email, hash, pseudo, role FROM "user" WHERE (LOWER(email) = LOWER(:email) OR LOWER(pseudo) = LOWER(:pseudo))');
        $stmt->setFetchMode(\PDO::FETCH_CLASS, User::class);
        $stmt->bindParam(':email', $login, \PDO::PARAM_STR);
        $stmt->bindParam(':pseudo', $login, \PDO::PARAM_STR);

        if (!$stmt->execute()) return false;

        return $stmt->fetch();
    }

    public function createUser($user)
    {
        $pseudo = $user->getPseudo();
        $email = $user->getEmail();
        $hash = $user->getHash();
        $role = $user->getRole();

        $stmt = $this->connection->prepare('INSERT INTO "user"(pseudo, email, hash, role) VALUES (:pseudo, :email, :hash, :role)');
        $stmt->bindParam(':pseudo', $pseudo, \PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->bindParam(':hash', $hash, \PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, \PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function updatePassword($id, $hash)
    {
        $stmt = $this->connection->prepare('UPDATE "user" SET hash=:hash where id=:id');
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->bindParam(':hash', $hash, \PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function isValidUser(User $user)
    {
        $email = $user->getEmail();
        $pseudo = $user->getPseudo();

        $stmt = $this->connection->prepare('SELECT count(*) FROM "user" WHERE email = :email OR pseudo = :pseudo');
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->bindParam(':pseudo', $pseudo, \PDO::PARAM_STR);

        if (!$stmt->execute()) return false;

        return $stmt->fetchColumn() < 1;
    }

    public function fetchById(int $id)
    {
        $stmt = $this->connection->prepare('SELECT id, email, pseudo, role FROM "user" WHERE id = :id');
        $stmt->setFetchMode(\PDO::FETCH_CLASS, User::class);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        if (!$stmt->execute()) return false;

        $user = $stmt->fetch();
        if (!$user) return false;

        $keywords = $this->keywordRepository->getKeywordsByUserId($id);
        if($keywords != null)
            $user->addKeywords($keywords);

        return $user;
    }


    public function fetchFullById(int $id)
    {
        $stmt = $this->connection->prepare('SELECT * FROM "user" WHERE id = :id');
        $stmt->setFetchMode(\PDO::FETCH_CLASS, User::class);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        if (!$stmt->execute()) return false;

        $user = $stmt->fetch();
        if (!$user) return false;

        $keywords = $this->keywordRepository->getKeywordsByUserId($id);
        if($keywords != null)
            $user->addKeywords($keywords);

        return $user;
    }

}
