<?php

namespace AppBundle\Entity;

/**
 * Blog
 */
class Blog
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
     * @var string
     */
    private $img1;

    /**
     * @var string
     */
    private $img2;

    /**
     * @var string
     */
    private $contentTxt;

    /**
     * @var string
     */
    private $createdFrom;

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
        $this->createdAt = new \DateTime();
        $this->views = 0;
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
     * Set name
     *
     * @param string $name
     *
     * @return Blog
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
     * Set img1
     *
     * @param string $img1
     *
     * @return Blog
     */
    public function setImg1($img1)
    {
        $this->img1 = $img1;

        return $this;
    }

    /**
     * Get img1
     *
     * @return string
     */
    public function getImg1()
    {
        return $this->img1;
    }

    /**
     * Set img2
     *
     * @param string $img2
     *
     * @return Blog
     */
    public function setImg2($img2)
    {
        $this->img2 = $img2;

        return $this;
    }

    /**
     * Get img2
     *
     * @return string
     */
    public function getImg2()
    {
        return $this->img2;
    }

    /**
     * Set contentTxt
     *
     * @param string $contentTxt
     *
     * @return Blog
     */
    public function setContentTxt($contentTxt)
    {
        $this->contentTxt = $contentTxt;

        return $this;
    }

    /**
     * Get contentTxt
     *
     * @return string
     */
    public function getContentTxt()
    {
        return $this->contentTxt;
    }

    /**
     * Set createdFrom
     *
     * @param string $createdFrom
     *
     * @return Blog
     */
    public function setCreatedFrom($createdFrom)
    {
        $this->createdFrom = $createdFrom;

        return $this;
    }

    /**
     * Get createdFrom
     *
     * @return string
     */
    public function getCreatedFrom()
    {
        return $this->createdFrom;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Blog
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
     * @param int $views
     */
    public function setViews($views)
    {
        $this->views = $views;
    }
}

