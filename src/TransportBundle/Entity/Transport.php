<?php

/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 31/03/2018
 * Time: 21:10
 */
namespace TransportBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Transport")
 */

class Transport
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_transport", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTransport;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=250, nullable=true)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=250, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=250, nullable=true)
     */
    private $depart;

    /**
     * @var string
     *
     * @ORM\Column(name="arrive", type="string", length=250, nullable=true)
     */
    private $arrive;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=250, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=250, nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=250, nullable=true)
     */
    private $place;

    /**
     * @var string
     *
     * @ORM\Column(name="frais", type="string", length=250, nullable=true)
     */
    private $frais;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=250, nullable=true)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="arriveName", type="string", length=250, nullable=true)
     */
    private $arrivename;

    /**
     * @var string
     *
     * @ORM\Column(name="departName", type="string", length=250, nullable=true)
     */
    private $departname;

    /**
     * @ORM\Column(name="idCreateur", type="integer", nullable=false)
     */
    private $idCreateur;

    /**
     * Get idTransport
     *
     * @return integer
     */
    public function getIdTransport()
    {
        return $this->idTransport;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return Transport
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Transport
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set depart
     *
     * @param string $depart
     *
     * @return Transport
     */
    public function setDepart($depart)
    {
        $this->depart = $depart;

        return $this;
    }

    /**
     * Get depart
     *
     * @return string
     */
    public function getDepart()
    {
        return $this->depart;
    }

    /**
     * Set arrive
     *
     * @param string $arrive
     *
     * @return Transport
     */
    public function setArrive($arrive)
    {
        $this->arrive = $arrive;

        return $this;
    }

    /**
     * Get arrive
     *
     * @return string
     */
    public function getArrive()
    {
        return $this->arrive;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Transport
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Transport
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set place
     *
     * @param string $place
     *
     * @return Transport
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set frais
     *
     * @param string $frais
     *
     * @return Transport
     */
    public function setFrais($frais)
    {
        $this->frais = $frais;

        return $this;
    }

    /**
     * Get frais
     *
     * @return string
     */
    public function getFrais()
    {
        return $this->frais;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Transport
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Transport
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set arrivename
     *
     * @param string $arrivename
     *
     * @return Transport
     */
    public function setArrivename($arrivename)
    {
        $this->arrivename = $arrivename;

        return $this;
    }

    /**
     * Get arrivename
     *
     * @return string
     */
    public function getArrivename()
    {
        return $this->arrivename;
    }

    /**
     * Set departname
     *
     * @param string $departname
     *
     * @return Transport
     */
    public function setDepartname($departname)
    {
        $this->departname = $departname;

        return $this;
    }

    /**
     * Get departname
     *
     * @return string
     */
    public function getDepartname()
    {
        return $this->departname;
    }

    /**
     * @return mixed
     */
    public function getIdCreateur()
    {
        return $this->idCreateur;
    }

    /**
     * @param mixed $idCreateur
     */
    public function setIdCreateur($idCreateur)
    {
        $this->idCreateur = $idCreateur;
    }
}
