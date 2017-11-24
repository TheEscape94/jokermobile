<?php

namespace AppBundle\Entity;

/**
 * Searches
 */
class Searches
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $search;

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
     * Set search
     *
     * @param string $search
     *
     * @return Searches
     */
    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    /**
     * Get search
     *
     * @return string
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Searches
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

