<?php

namespace Entity;


class Comment
{
    /**
     * @var int
     */
    private $id_comment;

    /**
     * @var int
     */
    private $id_user;

    /**
     * @var int
     */
    private $id_resto;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $text;

    /**
     * @var int
     */
    private $score;

    /**
     * @return int
     */
    public function getIdComment()
    {
        return $this->id_comment;
    }

    /**
     * @param int $id_comment
     * @return Comment
     */
    public function setIdComment($id_comment)
    {
        $this->id_comment = $id_comment;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     * @return Comment
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdResto()
    {
        return $this->id_resto;
    }

    /**
     * @param int $id_resto
     * @return Comment
     */
    public function setIdResto($id_resto)
    {
        $this->id_resto = $id_resto;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Comment
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return Comment
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param int $score
     * @return Comment
     */
    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }

}