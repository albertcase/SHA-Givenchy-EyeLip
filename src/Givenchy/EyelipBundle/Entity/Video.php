<?php

namespace Givenchy\EyelipBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Video
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Video
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
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var integer
     *
     * @ORM\Column(name="ballot", type="integer")
     */
    private $ballot;

    /**
     * @var integer
     *
     * @ORM\Column(name="created", type="integer")
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="Info", inversedBy="video")
     * @ORM\JoinColumn(name="info_id", referencedColumnName="id")
     */
    private $info;

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
     * Set url
     *
     * @param string $url
     * @return Video
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set created
     *
     * @param integer $created
     * @return Video
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

    /**
     * Set info
     *
     * @param \Givenchy\EyelipBundle\Entity\Info $info
     * @return Video
     */
    public function setInfo(\Givenchy\EyelipBundle\Entity\Info $info = null)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return \Givenchy\EyelipBundle\Entity\Info 
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set ballot
     *
     * @param integer $ballot
     * @return Video
     */
    public function setBallot($ballot)
    {
        $this->ballot = $ballot;

        return $this;
    }

    /**
     * Get ballot
     *
     * @return integer 
     */
    public function getBallot()
    {
        return $this->ballot;
    }
}
