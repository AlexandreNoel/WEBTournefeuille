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
     * @var \Client\Entity\Client
     */
    private $client;
    /**
     * @var \Client\Entity\Client
     */
    private $barmen;

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
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function computePrice(): Transaction
    {

        $price=0;
        foreach ($this->product as $key)  {
            $price+= $this->product->current()->getPrice()*intval($this->product->getInfo());
        }
        $this->price = $price;
        return $this;
    }
    /**
     * @param float $price
     */
    public function setPrice(float $price): Transaction
    {
        $this->price = $price;
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
        return $this->barmen;
    }

    /**
     * @param \Client\Entity\Client $Barmen
     */
    public function setBarmen(\Client\Entity\Client $Barmen): Transaction
    {
        $this->barmen = $Barmen;
        return $this;
    }


}