<?php

namespace AppBundle\Entity;

/**
 * Categories_kit
 */
class Categories_kit
{
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
    private $upName;


    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var bool
     */
    private $enabled;

    function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->enabled = 1;
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
    public function getUpName()
    {
        return $this->upName;
    }

    /**
     * @param int $upName
     */
    public function setUpName($upName)
    {
        $this->upName = $upName;
    }



    /**
     * Set name
     *
     * @param string $name
     *
     * @return Categories_kit
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Categories_kit
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
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Categories_kit
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
}

