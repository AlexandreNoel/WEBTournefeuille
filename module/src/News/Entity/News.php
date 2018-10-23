<?php

namespace News\Entity;
class News{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $contenu;

    /**
     * @var int
     */
    private $idauteur;

    /**
     * @var date
     */
    private $dateCreation;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param string $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdauteur()
    {
        return $this->idauteur;
    }

    /**
     * @param int $idauteur
     */
    public function setIdauteur($idauteur)
    {
        $this->idauteur = $idauteur;
        return $this;
    }

    /**
     * @return date
     */
    public function getDateCreation(): date
    {
        return $this->dateCreation;
    }

    /**
     * @param date $dateCreation
     */
    public function setDateCreation(date $dateCreation)
    {
        $this->dateCreation = $dateCreation;
        return $this;
    }

}