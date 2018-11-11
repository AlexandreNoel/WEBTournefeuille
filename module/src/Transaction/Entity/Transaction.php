<?php
/**
 * Created by PhpStorm.
 * User: theo
 * Date: 24/10/18
 * Time: 22:19
 */
namespace Transaction\Entity;
/**
 * Class Product
 * @package \Transaction\Entity
 */
class Transaction
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var \DateTime
     */
    private $Date;
    /**
     * @var float
     */
    private $price;
    /**
     * @var \SplObjectStorage
     */
    private $product;
    /**
     * @var int
     */
    private $idclient;
    /**
     * @var int
     */
    private $idbarmen;

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
    public function setId(?int $id): Transaction
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->Date;
    }

    /**
     * @param \DateTime $Date
     */
    public function setDate(\DateTime $Date): Transaction
    {
        $this->Date = $Date;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return bcdiv($this->price,1,2);
    }

    /**
     * @param int $price
     */
    public function computePrice(): Transaction
    {

        $price=0;
        foreach ($this->product as $key)  {
            $productprice=$this->product->current()->getPrice();
            $totalprice= $productprice*intval($this->product->getInfo());
            $totalprice-=$totalprice*($this->product->current()->getReduction()/100);
            $price+= $totalprice;
        }
        $this->price = bcdiv($price,1,2);
        return $this;
    }

    /**
     * @return array
     */
    public function getProduct(): \SplObjectStorage
    {
        return $this->product;
    }

    /**
     * @param array $product
     */
    public function setProduct(\SplObjectStorage $product): Transaction
    {
        $this->product = $product;
        $this->computePrice();
        return $this;
    }

    /**
     * @return \Client\Entity\Client
     */
    public function getIdClient(): ?int
    {
        return $this->idclient;
    }

    /**
     * @param \Client\Entity\Client $client
     */
    public function setIdClient(int $client): Transaction
    {
        $this->idclient = $client;
        return $this;
    }

    /**
     * @return \Client\Entity\Client
     */
    public function getIdBarmen(): int
    {
        return $this->idbarmen;
    }

    /**
     * @param \Client\Entity\Client $Barmen
     */
    public function setIdBarmen(int $Barmen): Transaction
    {
        $this->idbarmen = $Barmen;
        return $this;
    }


}