<?php

namespace AppBundle\Entity;

/**
 * Equiment
 */
class Equiment
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $category;

    /**
     * @var string
     */
    private $mark;

    /**
     * @var string
     */
    private $name;

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
    private $description;

    /**
     * @var string
     */
    private $images;

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
     * @return int
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param int $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }



    /**
     * Set mark
     *
     * @param string $mark
     *
     * @return Equiment
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
     * Set name
     *
     * @param string $name
     *
     * @return Equiment
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set myPrice
     *
     * @param int $myPrice
     *
     * @return Equiment
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
     * @return Equiment
     */
    public function setPriceOff($priceOff)
    {
        $this->priceOff = $priceOff;

        return $this;
    }

    /**
     * Get priceOff
     *
     * @return int
     */
    public function getPriceOff()
    {
        return $this->priceOff;
    }

    /**
     * Set price
     *
     * @param int $price
     *
     * @return Equiment
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Equiment
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
     * Set videoLink
     *
     * @param string $videoLink
     *
     * @return Equiment
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
     * @return Equiment
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
     * @return Equiment
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
     * @return Equiment
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
     * Set views
     *
     * @param integer $views
     *
     * @return Equiment
     */
    public function setViews($views)
    {
        $this->views = $views;

        return $this;
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
     * Get views
     *
     * @return int
     */
    public function getViews()
    {
        return $this->views;
    }
}

