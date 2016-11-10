<?php

namespace CentralStorageBundle\Entity;

/**
 * Library
 */
class Library
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $host;

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
     * Set host
     *
     * @param string $host
     *
     * @return Library
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get host
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }
}
