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
     * @var int
     */
    private $idrole;

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
    public function getSolde(): int
    {
        return $this->solde;
    }

    /**
     * @param int $solde
     */
    public function setSolde(int $solde): Client
    {
        $this->solde = $solde;
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
     * @return int
     */
    public function getIdrole(): int
    {
        return $this->idrole;
    }

    /**
     * @param int $idrole
     */
    public function setIdrole(int $idrole): Client
    {
        $this->idrole = $idrole;
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

