<?php

namespace LibraryBundle\Entity;

/**
 * Book
 */
class Book
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var \LibraryBundle\Entity\User
     */
    private $user;

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
     * Set title
     *
     * @param string $title
     *
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set user
     *
     * @param \LibraryBundle\Entity\User $user
     *
     * @return Book
     */
    public function setUser(\LibraryBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \LibraryBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @var \LibraryBundle\Entity\User
     */
    private $library;

    /**
     * Set library
     *
     * @param \LibraryBundle\Entity\User $library
     *
     * @return Book
     */
    public function setLibrary(\LibraryBundle\Entity\User $library = null)
    {
        $this->library = $library;

        return $this;
    }

    /**
     * Get library
     *
     * @return \LibraryBundle\Entity\User
     */
    public function getLibrary()
    {
        return $this->library;
    }
}
