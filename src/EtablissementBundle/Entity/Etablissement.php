<?php

namespace EtablissementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AllForKids\EntityBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Etablissement
 *
 * @ORM\Table(name="etablissement", indexes={@ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 */
class Etablissement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_etablissement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEtablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255, nullable=false)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Ajouter une image jpg")
<<<<<<< HEAD
     * @Assert\File(mimeTypes={ "image/jpeg" ,"image/png"})
=======
     * @Assert\File(mimeTypes={ "image/jpg" ,"image/png"})
>>>>>>> be55639eaef63b98511947bd5e9a9b6b417c1183
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="verification", type="string", length=255, nullable=true,options={"default" :"Non valide"})
     */
    private $verification="Non valide";

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="AllForKids\EntityBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @ORM\OneToMany(targetEntity="EtablissementBundle\Entity\Rejoindre", mappedBy="etablissement", fetch="EXTRA_LAZY")
     */
    private $rejoindres;

    /**
     * @return int
     */
    public function getIdEtablissement()
    {
        return $this->idEtablissement;
    }

    /**
     * @param int $idEtablissement
     */
    public function setIdEtablissement($idEtablissement)
    {
        $this->idEtablissement = $idEtablissement;
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
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
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
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getVerification()
    {
        return $this->verification;
    }

    /**
     * @param string $verification
     */
    public function setVerification($verification)
    {
        $this->verification = $verification;
    }

    /**
     * @return \User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param \User $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rejoindres = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add rejoindre
     *
     * @param \EtablissementBundle\Entity\Rejoindre $rejoindre
     *
     * @return Etablissement
     */
    public function addRejoindre(\EtablissementBundle\Entity\Rejoindre $rejoindre)
    {
        $this->rejoindres[] = $rejoindre;

        return $this;
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


}
