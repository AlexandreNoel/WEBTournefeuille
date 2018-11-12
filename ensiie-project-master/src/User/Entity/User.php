<?php
namespace User\Entity;

class User
{

    private $id;

    /**
     * @var string
     */
    private $nameu;

    private $passwordp;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var \username
     */
    private $username;

      /**
     * @var \mail
     */
    private $mail;
    /**
     * @return int
     */
    private $genre;

    /**
     * @return string
     */


     public function setId($id){
         $this->id=$id;
         return $this;
     }
     public function getId(){
         return $this->id;
     }

    public function getName()
    {
        return $this->nameu;
    }

    /**
     * @param string $firstname
     * @return User
     */
    public function setName($name)
    {
        $this->nameu = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setLastName($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return \username
     */
    public function getUsername() //: \DateTimeInterface
    {
        return $this->username;
    }

    /**
     * @param \DateTimeInterface $birthday
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }


    /**
     * @return int
     * @throws \OutOfRangeException
     */
    public function getMail()
    {
        return $this->mail;
    }
    
    public function setMail($mail)
    {
         $this->mail = $mail;
         return $this;
    }


    public function getPassword()
    {
        return $this->passwordp;
    }
    
    public function setPassword($password)
    {
         $this->passwordp = $password;
         return $this;
    }

public function setGenre($genre){
    $this->genre=$genre;
    return $this;
}
public function getGenre(){
    return $this->genre;
}
}

