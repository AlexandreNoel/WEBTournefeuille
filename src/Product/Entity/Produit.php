<?php
/**
 * Created by PhpStorm.
 * User: theo
 * Date: 17/10/18
 * Time: 17:18
 */
Class Produit{

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
    private $idfamille;

    /**
     * @var int
     */
    private $Quantity;

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
    public function setId(int $id): void
    {
        $this->id = $id;
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
    public function setName(string $name): void
    {
        $this->name = $name;
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
    public function setPrice(int $price): void
    {
        $this->price = $price;
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
    public function setReduction(int $reduction): void
    {
        $this->reduction = $reduction;
    }

    /**
     * @return int
     */
    public function getIdfamille(): int
    {
        return $this->idfamille;
    }

    /**
     * @param int $idfamille
     */
    public function setIdfamille(int $idfamille): void
    {
        $this->idfamille = $idfamille;
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
    public function setQuantity(int $Quantity): void
    {
        if ($Quantity>0){
        $this->Quantity = $Quantity;
        }
    }
    /**
     * @param int $Quantity
     */
    public function addQuantity(int $Quantity): void
    {
        if ($Quantity > 0){
            $this->Quantity += $Quantity;
        }
        else{
            throwException(U_ILLEGAL_ARGUMENT_ERROR);
        }
    }
    /**
     * @param int $Quantity
     */
    public function removeQuantity(int $Quantity): void
    {
        if ($Quantity > 0){
            $this->Quantity -= $Quantity;
        }
        else{
            throwException(U_ILLEGAL_ARGUMENT_ERROR);
        }
    }




}