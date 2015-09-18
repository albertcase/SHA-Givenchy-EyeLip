<?php

namespace Givenchy\EyelipBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Likelog
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Likelog
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", length=255)
     */
    private $uuid;

    /**
     * @var integer
     *
     * @ORM\Column(name="video_id", type="integer")
     */
    private $videoId;

    /**
     * @var integer
     *
     * @ORM\Column(name="created", type="integer")
     */
    private $created;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set uuid
     *
     * @param string $uuid
     * @return Likelog
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get uuid
     *
     * @return string 
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set videoId
     *
     * @param integer $videoId
     * @return Likelog
     */
    public function setVideoId($videoId)
    {
        $this->videoId = $videoId;

        return $this;
    }

    /**
     * Get videoId
     *
     * @return integer 
     */
    public function getVideoId()
    {
        return $this->videoId;
    }

    /**
     * Set created
     *
     * @param integer $created
     * @return Likelog
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return integer 
     */
    public function getCreated()
    {
        return $this->created;
    }
}
