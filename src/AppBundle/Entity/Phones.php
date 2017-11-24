<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Phones
 */
class Phones
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $mark;

    /**
     * @var string
     */
    private $model;

    /**
     * @var int
     */
    private $isNew;

    /**
     * @var int
     */
    private $stateNum;

    /**
     * @var string
     */
    private $garanty;

    /**
     * @var string
     */
    private $kit;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $network;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var string
     */
    private $images;

    /**
     * @var int
     */
    private $myPrice;

    /**
     * @var int
     */
    private $priceOff;

    /**
     * @var int
     */
    private $price;

    /**
     * @var string
     */
    private $videoLink;

    /**
     * @var string
     */
    private $link;

    /**
     * @var string
     */
    private $funFact;

    /**
     * @var string
     */
    private $tags;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var int
     */
    private $views;

    function __construct()
    {
        $this->views = 0;
        $this->createdAt = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set mark
     *
     * @param string $mark
     *
     * @return Phones
     */
    public function setMark($mark)
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * Get mark
     *
     * @return string
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set model
     *
     * @param string $model
     *
     * @return Phones
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set isNew
     *
     * @param integer $isNew
     *
     * @return Phones
     */
    public function setIsNew($isNew)
    {
        $this->isNew = $isNew;

        return $this;
    }

    /**
     * Get isNew
     *
     * @return int
     */
    public function getIsNew()
    {
        return $this->isNew;
    }

    /**
     * Set stateNum
     *
     * @param integer $stateNum
     *
     * @return Phones
     */
    public function setStateNum($stateNum)
    {
        $this->stateNum = $stateNum;

        return $this;
    }

    /**
     * Get stateNum
     *
     * @return int
     */
    public function getStateNum()
    {
        return $this->stateNum;
    }

    /**
     * Set garanty
     *
     * @param string $garanty
     *
     * @return Phones
     */
    public function setGaranty($garanty)
    {
        $this->garanty = $garanty;

        return $this;
    }

    /**
     * Get garanty
     *
     * @return string
     */
    public function getGaranty()
    {
        return $this->garanty;
    }

    /**
     * Set kit
     *
     * @param string $kit
     *
     * @return Phones
     */
    public function setKit($kit)
    {
        $this->kit = $kit;

        return $this;
    }

    /**
     * Get kit
     *
     * @return string
     */
    public function getKit()
    {
        return $this->kit;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Phones
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set network
     *
     * @param integer $network
     *
     * @return Phones
     */
    public function setNetwork($network)
    {
        $this->network = $network;

        return $this;
    }

    /**
     * Get network
     *
     * @return int
     */
    public function getNetwork()
    {
        return $this->network;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Phones
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param string $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }


    /**
     * Set myPrice
     *
     * @param int $myPrice
     *
     * @return Phones
     */
    public function setMyPrice($myPrice)
    {
        $this->myPrice = $myPrice;

        return $this;
    }

    /**
     * Get myPrice
     *
     * @return int
     */
    public function getMyPrice()
    {
        return $this->myPrice;
    }

    /**
     * Set priceOff
     *
     * @param int $priceOff
     *
     * @return Phones
     */
    public function setPriceOff($priceOff)
    {
        $this->priceOff = $priceOff;

        return $this;
    }

    /**
     * Get priceOff
     *
     * @return integer
     */
    public function getPriceOff()
    {
        return $this->priceOff;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Phones
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set videoLink
     *
     * @param string $videoLink
     *
     * @return Phones
     */
    public function setVideoLink($videoLink)
    {
        $this->videoLink = $videoLink;

        return $this;
    }

    /**
     * Get videoLink
     *
     * @return string
     */
    public function getVideoLink()
    {
        return $this->videoLink;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Phones
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set funFact
     *
     * @param string $funFact
     *
     * @return Phones
     */
    public function setFunFact($funFact)
    {
        $this->funFact = $funFact;

        return $this;
    }

    /**
     * Get funFact
     *
     * @return string
     */
    public function getFunFact()
    {
        return $this->funFact;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Phones
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return int
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param string $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @param int $views
     */
    public function setViews($views)
    {
        $this->views = $views;
    }


}

