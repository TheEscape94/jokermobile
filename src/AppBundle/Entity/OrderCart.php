<?php

namespace AppBundle\Entity;

/**
 * OrderCart
 */
class OrderCart
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $orderNum;

    /**
     * @var string
     */
    private $discount;

    /**
     * @var string
     */
    private $discountName;

    /**
     * @var string
     */
    private $orderTxt;

    /**
     * @var string
     */
    private $orderPrice;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $lastName;

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
    private $phone;

    /**
     * @var string
     */
    private $email;

    /**
     * @var bool
     */
    private $isRead;

    /**
     * @var bool
     */
    private $delivered;

    /**
     * @var \DateTime
     */
    private $createdAt;

    function __construct()
    {
        $this->delivered = 0;
        $this->isRead = 0;
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
     * Set orderNum
     *
     * @param integer $orderNum
     *
     * @return OrderCart
     */
    public function setOrderNum($orderNum)
    {
        $this->orderNum = $orderNum;

        return $this;
    }

    /**
     * Get orderNum
     *
     * @return int
     */
    public function getOrderNum()
    {
        return $this->orderNum;
    }

    /**
     * Set orderTxt
     *
     * @param string $orderTxt
     *
     * @return OrderCart
     */
    public function setOrderTxt($orderTxt)
    {
        $this->orderTxt = $orderTxt;

        return $this;
    }

    /**
     * Get orderTxt
     *
     * @return string
     */
    public function getOrderTxt()
    {
        return $this->orderTxt;
    }

    /**
     * Set orderPrice
     *
     * @param string $orderPrice
     *
     * @return OrderCart
     */
    public function setOrderPrice($orderPrice)
    {
        $this->orderPrice = $orderPrice;

        return $this;
    }

    /**
     * Get orderPrice
     *
     * @return string
     */
    public function getOrderPrice()
    {
        return $this->orderPrice;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return OrderCart
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
     * Set lastName
     *
     * @param string $lastName
     *
     * @return OrderCart
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set adress
     *
     * @param string $adress
     *
     * @return OrderCart
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return OrderCart
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return OrderCart
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return OrderCart
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isRead
     *
     * @param boolean $isRead
     *
     * @return OrderCart
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
     * Set delivered
     *
     * @param boolean $delivered
     *
     * @return OrderCart
     */
    public function setDelivered($delivered)
    {
        $this->delivered = $delivered;

        return $this;
    }

    /**
     * Get delivered
     *
     * @return bool
     */
    public function getDelivered()
    {
        return $this->delivered;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return OrderCart
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param string $discount
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
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
     * @return string
     */
    public function getDiscountName()
    {
        return $this->discountName;
    }

    /**
     * @param string $discountName
     */
    public function setDiscountName($discountName)
    {
        $this->discountName = $discountName;
    }

}

