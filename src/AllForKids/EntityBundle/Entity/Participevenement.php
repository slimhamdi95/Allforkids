<?php

namespace AllForKids\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participevenement
 *
 * @ORM\Table(name="participevenement", indexes={@ORM\Index(name="id_evenement", columns={"id_evenement"}), @ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 */
class Participevenement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_evenement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idEvenement;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private $type;


}

