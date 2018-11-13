<?php
namespace User;

class User
{
    private $id;
    private $pseudo;
    private $email;
    private $hash;
    private $role;
    private $keywords = [];

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getHash()
    {
        return $this->hash;
    }

    public function setHash($hash)
    {
        $this->hash = $hash;
        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    public function getkeywords()
    {
        return $this->keywords;
    }

    public function addKeywords(array $keywords)
    {
        if (isset($keywords) && sizeof($keywords) > 0) {
            array_push($this->keywords, ...$keywords);
        }
        return $this;
    }
}
