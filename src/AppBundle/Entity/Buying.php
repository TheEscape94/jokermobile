<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Buying
 */

class Buying
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $phoneModel;

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
    private $network;

    /**
     * @var string
     */
    private $kit;

    /**
     * @var string
     */
    private $images;


    /**
     * @var string
     */
    private $price;

    /**
     * @var string
     */
    private $description;

    /**
     * @var bool
     */
    private $isRead;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $phoneNum;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $adress;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $postNum;

    /**
     * @var \DateTime
     */
    private $createdAt;


    function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->isRead = 0;
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
     * Set phoneModel
     *
     * @param string $phoneModel
     *
     * @return Buying
     */
    public function setPhoneModel($phoneModel)
    {
        $this->phoneModel = $phoneModel;

        return $this;
    }

    /**
     * Get phoneModel
     *
     * @return string
     */
    public function getPhoneModel()
    {
        return $this->phoneModel;
    }

    /**
     * Set isNew
     *
     * @param integer $isNew
     *
     * @return Buying
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
     * @return Buying
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
     * Set network
     *
     * @param string $network
     *
     * @return Buying
     */
    public function setNetwork($network)
    {
        $this->network = $network;

        return $this;
    }

    /**
     * Get network
     *
     * @return string
     */
    public function getNetwork()
    {
        return $this->network;
    }

    /**
     * Set kit
     *
     * @param string $kit
     *
     * @return Buying
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
     * Set price
     *
     * @param string $price
     *
     * @return Buying
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
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
     * @return Buying
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
     * Set isRead
     *
     * @param boolean $isRead
     *
     * @return Buying
     */
    public function setIsRead($isRead)
    {
        $this->isRead = $isRead;

        return $this;
    }

    /**
     * Get isRead
     *
     * @return bool
     */
    public function getIsRead()
    {
        return $this->isRead;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Buying
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPhoneNum()
    {
        return $this->phoneNum;
    }

    /**
     * @param string $phoneNum
     */
    public function setPhoneNum($phoneNum)
    {
        $this->phoneNum = $phoneNum;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * @param string $adress
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getPostNum()
    {
        return $this->postNum;
    }

    /**
     * @param string $postNum
     */
    public function setPostNum($postNum)
    {
        $this->postNum = $postNum;
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
}

