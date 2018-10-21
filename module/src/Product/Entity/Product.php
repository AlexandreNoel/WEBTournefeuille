<?php
/**
 * Created by PhpStorm.
 * User: theo
 * Date: 17/10/18
 * Time: 17:18
 */
namespace Product\Entity;
/**
 * Class Product
 * @package Product\Entity
 */
Class Product{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $price;

    /**
     * @var int
     */
    private $reduction;

    /**
     * @var int
     */
    private $idfamilly;

    /**
     * @var int
     */
    private $Quantity;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(?int $id): Product
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): Product
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return int
     */
    public function getReduction(): int
    {
        return $this->reduction;
    }

    /**
     * @param int $reduction
     */
    public function setReduction(int $reduction): Product
    {
        $this->reduction = $reduction;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdfamilly(): int
    {
        return $this->idfamilly;
    }

    /**
     * @param int $idfamilly
     */
    public function setIdfamilly(int $idfamilly): Product
    {
        $this->idfamilly = $idfamilly;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->Quantity;
    }

    /**
     * @param int $Quantity
     */
    public function setQuantity(int $Quantity): Product
    {
        if ($Quantity>0){
            $this->Quantity = $Quantity;
            return $this;
        }
        else{
            throwException(U_ILLEGAL_ARGUMENT_ERROR);
        }
    }
    /**
     * @param int $Quantity
     */
    public function addQuantity(int $Quantity): Product
    {
        if ($Quantity > 0){
            $this->Quantity += $Quantity;
            return $this;
        }
        else{
            throwException(U_ILLEGAL_ARGUMENT_ERROR);
        }
    }
    /**
     * @param int $Quantity
     */
    public function removeQuantity(int $Quantity): Product
    {
        if ($Quantity > 0){
            $this->Quantity -= $Quantity;
            return $this;
        }
        else{
            throwException(U_ILLEGAL_ARGUMENT_ERROR);
        }
    }




}