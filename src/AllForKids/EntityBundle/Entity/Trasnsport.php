<?php

namespace AllForKids\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trasnsport
 *
 * @ORM\Table(name="trasnsport", indexes={@ORM\Index(name="id_user", columns={"id_user1"})})
 * @ORM\Entity
 */
class Trasnsport
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
     * @ORM\Column(name="region", type="string", length=250, nullable=false)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=250, nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=250, nullable=false)
     */
    private $depart;

    /**
     * @var string
     *
     * @ORM\Column(name="arrivÃ©", type="string", length=250, nullable=false)
     */
    private $arrivã©;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=250, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=250, nullable=false)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=250, nullable=false)
     */
    private $place;

    /**
     * @var string
     *
     * @ORM\Column(name="frais", type="string", length=250, nullable=false)
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
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="arriveName", type="string", length=250, nullable=false)
     */
    private $arrivename;

    /**
     * @var string
     *
     * @ORM\Column(name="departName", type="string", length=250, nullable=false)
     */
    private $departname;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user1", referencedColumnName="id")
     * })
     */
    private $idUser1;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", inversedBy="idTransport")
     * @ORM\JoinTable(name="transportrejoindr",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_transport", referencedColumnName="id_transport")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     *   }
     * )
     */
    private $idUser;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idUser = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

