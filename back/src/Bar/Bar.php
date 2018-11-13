<?php
namespace Bar;

class Bar
{
    private $id;
    private $name;
    private $address;
    private $keywords = [];
    private $arrayComm = [];
    private $photoreference;
    private $rating;
    private $placeId;
    private $lat;
    private $lng;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    public function getKeywords()
    {
        return $this->keywords;
    }

    public function addKeywords(array $keywords)
    {
        if (isset($keywords) && sizeof($keywords) > 0) {
            array_push($this->keywords, ...$keywords);
        }
        return $this;
    }

    public function getComments()
    {
        return $this->arrayComm;
    }

    public function addComments(array $comments)
    {
        if (isset($comments) && sizeof($comments) > 0)
        {
            array_push($this->arrayComm, ...$comments);
        }
        return $this;
    }

    public function getPhoto()
    {
        return $this->photoreference;
    }

    public function setPhoto(string $photoreference)
    {
        $this->photoreference = $photoreference;
        return $this;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating(string $rating)
    {
        $this->rating = $rating;
        return $this;
    }

    public function getLat(){
        return $this->lat;
    }

    public function setLat(string $lat)
    {
        $this->lat = $lat;
        return $this;
    }

    public function getLng()
    {
        return $this->lng;
    }

    public function setLng(string $lng)
    {
        $this->lng = $lng;
        return $this;
    }

    public function getPlaceId()
    {
        return $this->placeId;
    }

    public function setPlaceId($placeId)
    {
        $this->placeId = $placeId;
        return $this;
    }
}
