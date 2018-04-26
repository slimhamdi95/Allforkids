<?php

namespace AllForKids\EntityBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="cin", type="string", length=11, nullable=true)
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="pass", type="string", length=255, nullable=true)
     */
    private $pass;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     *
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=true)
     *
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = { "image/gif", "image/png"},
     *     maxSizeMessage = "The maxmimum allowed file size is 5MB.",
     *     mimeTypesMessage = "Type de Ficher non autorisées"
     * )
     */
    private $picture;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255, nullable=true)
     */
    private $role;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Livre", mappedBy="idUser")
     */
    private $idLiver;


    /**

     * @ORM\OneToMany(targetEntity="EtablissementBundle\Entity\Rejoindre", mappedBy="user", fetch="EXTRA_LAZY")
     */
    private $rejoindres;
    /**
     * @ORM\OneToMany(targetEntity="EtablissementBundle\Entity\Note", mappedBy="user", fetch="EXTRA_LAZY")
     */
    private $notes;

/**
     * @ORM\OneToMany(targetEntity="MedBundle\Entity\Article", mappedBy="user")
     */
    private $articles;


    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->idLiver = new \Doctrine\Common\Collections\ArrayCollection();

        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * @param string $cin
     */
    public function setCin($cin)
    {
        $this->cin = $cin;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdLiver()
    {
        return $this->idLiver;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $idLiver
     */
    public function setIdLiver($idLiver)
    {
        $this->idLiver = $idLiver;
    }



    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param string $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * Add rejoindre
     *
     * @param \EtablissementBundle\Entity\Rejoindre $rejoindre
     *
     * @return User
     */
    public function addRejoindre(\EtablissementBundle\Entity\Rejoindre $rejoindre)
    {
        $this->rejoindres[] = $rejoindre;

        return $this;
    }
/**
     * @return mixed
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param mixed $articles
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;
    }



    /**
     * Remove rejoindre
     *
     * @param \EtablissementBundle\Entity\Rejoindre $rejoindre
     */
    public function removeRejoindre(\EtablissementBundle\Entity\Rejoindre $rejoindre)
    {
        $this->rejoindres->removeElement($rejoindre);
    }

    /**
     * Get rejoindre
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRejoindres()
    {
        return $this->rejoindres;
    }

    /**
     * Add note
     *
     * @param \EtablissementBundle\Entity\Note $note
     *
     * @return User
     */
    public function addNote(\EtablissementBundle\Entity\Note $note)
    {
        $this->notes[] = $note;

        return $this;
    }

    /**
     * Remove note
     *
     * @param \EtablissementBundle\Entity\Note $note
     */
    public function removeNote(\EtablissementBundle\Entity\Note $note)
    {
        $this->notes->removeElement($note);
    }

    /**
     * Get notes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotes()
    {
        return $this->notes;
    }
}

