<?php

namespace EtablissementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rejoindre
 *
 * @ORM\Table(name="rejoindre")
 * @ORM\Entity(repositoryClass="EtablissementBundle\Repository\RejoindreRepository")
 */
class Rejoindre
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
     * @var string
     *
     * @ORM\Column(name="verification", type="string", length=255)
     */
    private $verification;

    /**
     * @ORM\ManyToOne(targetEntity="EtablissementBundle\Entity\Etablissement", inversedBy="rejoindres")
     * @ORM\JoinColumn(name="id_etablissement", referencedColumnName="id_etablissement", nullable=false)
     */
    private $etablissement;

    /**
     * @ORM\ManyToOne(targetEntity="AllForkids\EntityBundle\Entity\User", inversedBy="rejoindres")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id", nullable=false)
     */
    private $user;

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
     * Set verification
     *
     * @param string $verification
     *
     * @return Rejoindre
     */
    public function setVerification($verification)
    {
        $this->verification = $verification;

        return $this;
    }

    /**
     * Get verification
     *
     * @return string
     */
    public function getVerification()
    {
        return $this->verification;
    }

    /**
     * Set etablissement
     *
     * @param \EtablissementBundle\Entity\Etablissement $etablissement
     *
     * @return Rejoindre
     */
    public function setEtablissement(\EtablissementBundle\Entity\Etablissement $etablissement)
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * Get etablissement
     *
     * @return \EtablissementBundle\Entity\Etablissement
     */
    public function getEtablissement()
    {
        return $this->etablissement;
    }

    /**
     * Set user
     *
     * @param \AllForKids\EntityBundle\Entity\User $user
     *
     * @return Rejoindre
     */
    public function setUser(\AllForKids\EntityBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AllForKids\EntityBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
