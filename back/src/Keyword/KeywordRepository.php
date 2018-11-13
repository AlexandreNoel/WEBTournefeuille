<?php
namespace Keyword;

class KeywordRepository
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $stmt = $this->connection->query('SELECT id, name FROM keyword ORDER BY name ASC');
        if (!$stmt) {
            return false;
        }
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Keyword::class);
    }

    public function getIdByKeyword($keyword)
    {
        if(!isset($keyword)){
            return -1;
        }
        $stmt = $this->connection->prepare('Select id from "keyword" where name = :name');
        $stmt->bindParam(':name',$keyword, \PDO::PARAM_STR);
        if(!$stmt->execute()) return -1;
        return $stmt->fetchColumn();

    }
    public function addKeywordsByUser($user_id,$keyword_ids)
    {
        if(!(isset($user_id) && is_array($keyword_ids))){
            return False;
        }
        foreach($keyword_ids as $keyword_id)
        {
            $stmt = $this->connection->prepare('INSERT INTO "keyuser"(idUser, idKeyWord) VALUES (:idUser, :idKeyword)');
            $stmt->bindParam(':idUser',$user_id, \PDO::PARAM_INT);
            $stmt->bindParam(':idKeyword',$keyword_id, \PDO::PARAM_INT);
            if(!$stmt->execute()) return False;
        }
        return True;
    }

    public function deleteKeywordByUser($user_id,$keyword_id)
    {
        if(!(isset($user_id) && isset($keyword_id))){
            return False;
        }

        $stmt = $this->connection->prepare('DELETE FROM "keyuser" where idUser=:idUser AND idKeyWord=:idKeyword');
        $stmt->bindParam(':idUser',$user_id, \PDO::PARAM_INT);
        $stmt->bindParam(':idKeyword',$keyword_id, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getKeywordsByBarId($id)
    {
        $request = $this->connection->prepare('SELECT kw.id, kw.name FROM "keybar" kb, "bar" b, "keyword" kw WHERE kb.idBar = b.id AND kw.id = kb.idKeyWord AND b.id = :id');
        $request->bindParam(':id',$id, \PDO::PARAM_INT);

        if (!$request->execute()) return null;

        return $request->fetchAll(\PDO::FETCH_CLASS, Keyword::class);
    }

    public function getKeywordsByUserId($id)
    {
        $stmt = $this->connection->prepare('SELECT kw.id ,kw.name FROM "user" u, keyword kw, keyuser ku WHERE u.id = :id AND u.id = ku.idUser AND ku.idKeyWord = kw.id');
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        if (!$stmt->execute()) return false;
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Keyword::class);

    }
}
