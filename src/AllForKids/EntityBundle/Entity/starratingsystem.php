<?php
/**
 * Created by PhpStorm.
 * User: slim
 * Date: 09/04/2018
 * Time: 16:45
 */

namespace AllForKids\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * countries
 *
 * @ORM\Table(name="rating")
 * @ORM\Entity
 */
class starratingsystem
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="media", type="integer")
     */
    private $media;

    /**
     * @var integer
     *
     * @ORM\Column(name="rate", type="integer")
     */
    private $rate;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrrate", type="integer")
     */
    private $nbrrate;


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
     * Set media
     *
     * @param integer $media
     *
     * @return starratingsystem
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return integer
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set rate
     *
     * @param integer $rate
     *
     * @return starratingsystem
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return integer
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set nbrrate
     *
     * @param integer $nbrrate
     *
     * @return starratingsystem
     */
    public function setNbrrate($nbrrate)
    {
        $this->nbrrate = $nbrrate;

        return $this;
    }

    /**
     * Get nbrrate
     *
     * @return integer
     */
    public function getNbrrate()
    {
        return $this->nbrrate;
    }
}