<?php

namespace Givenchy\EyelipBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Send
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Send
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
     * @var integer
     *
     * @ORM\Column(name="ballot", type="integer")
     */
    private $ballot;

    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="integer")
     */
    private $uid;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=20)
     */
    private $mobile;


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
     * Set ballot
     *
     * @param integer $ballot
     * @return Send
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

    /**
     * Set uid
     *
     * @param integer $uid
     * @return Send
     */
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Get uid
     *
     * @return integer 
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return Send
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }
}
