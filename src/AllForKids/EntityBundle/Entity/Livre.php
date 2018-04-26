<?php

namespace AllForKids\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;
/**
 * Livre
 *
 * @ORM\Table(name="livre")
 * @ORM\Entity(repositoryClass="AllForKids\EntityBundle\Repository\LivreRepository")
 */
class Livre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_livre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLivre;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255, nullable=false)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="good", type="integer", nullable=false)
     */
    private $good;

    /**
     * @var integer
     *
     * @ORM\Column(name="bad", type="integer", nullable=false)
     */
    private $bad;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=false)
     *
     * @Assert\File(mimeTypes={ "image/png", "image/jpg" })
     *
     */
    private $photo;

    /**
     * @var string
     *@Assert\File(mimeTypes={ "application/pdf" })
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", inversedBy="idLiver")
     * @ORM\JoinTable(name="liverlike",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_liver", referencedColumnName="id_livre")
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

    /**
     * @return int
     */
    public function getIdLivre()
    {
        return $this->idLivre;
    }

    /**
     * @param int $idLivre
     */
    public function setIdLivre($idLivre)
    {
        $this->idLivre = $idLivre;
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
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param string $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getGood()
    {
        return $this->good;
    }

    /**
     * @param int $good
     */
    public function setGood($good)
    {
        $this->good = $good;
    }

    /**
     * @return int
     */
    public function getBad()
    {
        return $this->bad;
    }

    /**
     * @param int $bad
     */
    public function setBad($bad)
    {
        $this->bad = $bad;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

}

