<?php
namespace Food\Entity;

class Food
{
    /*Integer*/
 
    /*String*/
    private $name;
    /*String*/
    private $type;
    /*Double*/
    private $price;
    /*Integer*/
    private $quantity;
    /*Big Integer*/
    private $codebarre;
    /* date*/
    private $date;



    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setCodeBarre($codebarre)
    {
        $this->codebarre = $codebarre;
        return $this;
    }

    /**
     * @return string
     */
    public function getCodeBarre()
    {
        return $this->codebarre;
    }

    public function setDate($date){
        $this->date=$date;
        return $this;
    }
    public function getDate(){
        return $this->date;
    }
}

?>