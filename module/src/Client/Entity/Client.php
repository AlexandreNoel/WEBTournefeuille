<?php
namespace Client\Entity;

class Client
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $firstname;
/**
     * @var string
     */
    private $nickname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var int
     */
    private $solde;

    /**
     * @var string
     */
    private $codebarmen;

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): Client
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @param string $nickname
     */
    public function setNickname(string $nickname): Client
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): Client
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return int
     */
    public function getSolde(): float
    {
        return bcdiv($this->solde,1,2);
    }

    /**
     * @param int $solde
     */
    public function setSolde(float $solde): Client
    {
        $this->solde = bcdiv($solde,1,2);
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): Client
    {
        $this->id = $id;
        return $this;
    }

     /**
     * @return string
     */
    public function getCodebarmen(): ?string
    {
        return $this->codebarmen;
    }

    /**
     * @param string $codebarmen
     */
    public function setCodebarmen(?string $codebarmen): Client
    {
        $this->codebarmen = $codebarmen;
        return $this;
    }



}

