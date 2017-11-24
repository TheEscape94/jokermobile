<?php

namespace AppBundle\Entity;

/**
 * Discount
 */
class Discount
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var bool
     */
    private $type;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var string
     */
    private $discountPass;

    /**
     * @var \DateTime
     */
    private $createdAt;


    function __construct()
    {
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
     * Set type
     *
     * @param boolean $type
     *
     * @return Discount
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return bool
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Discount
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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Discount
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
     * Set discountPass
     *
     * @param string $discountPass
     *
     * @return Discount
     */
    public function setDiscountPass($discountPass)
    {
        $this->discountPass = $discountPass;

        return $this;
    }

    /**
     * Get discountPass
     *
     * @return string
     */
    public function getDiscountPass()
    {
        return $this->discountPass;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Discount
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
}

