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
     * @var dateTime
     */
    private $Date;
    /**
     * @var int
     */
    private $price;
    /**
     * @var array(\Product\Entity\Product,int)
     */
    private $product;
    /**
     * @var \Client\Entity\Client
     */
    private $client;
    /**
     * @var \Client\Entity\Client
     */
    private $Barmen;

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
    public function setId(int $id): Transaction
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return dateTime
     */
    public function getDate(): dateTime
    {
        return $this->Date;
    }

    /**
     * @param dateTime $Date
     */
    public function setDate(dateTime $Date): Transaction
    {
        $this->Date = $Date;
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
    public function setPrice(int $price): Transaction
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return array
     */
    public function getProduct(): array
    {
        return $this->product;
    }

    /**
     * @param array $product
     */
    public function setProduct(array $product): Transaction
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return \Client\Entity\Client
     */
    public function getClient(): \Client\Entity\Client
    {
        return $this->client;
    }

    /**
     * @param \Client\Entity\Client $client
     */
    public function setClient(\Client\Entity\Client $client): Transaction
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return \Client\Entity\Client
     */
    public function getBarmen(): \Client\Entity\Client
    {
        return $this->Barmen;
    }

    /**
     * @param \Client\Entity\Client $Barmen
     */
    public function setBarmen(\Client\Entity\Client $Barmen): Transaction
    {
        $this->Barmen = $Barmen;
        return $this;
    }


}