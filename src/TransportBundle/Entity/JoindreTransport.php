<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 08/04/2018
 * Time: 00:39
 */

namespace TransportBundle\Entity;
use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity
 * @ORM\Table(name="JoindreTransport")
 * @ORM\Entity(repositoryClass="TransportBundle\Repository\JoindreTransportRepository")
 */

class JoindreTransport
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_joindre_transport", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idJoindreTransport;

    /**
     * @var integer
     *
     * @ORM\Column(name="UserId", type="integer",  nullable=true)
     */
    private $UserId;

    /**
     * @var integer
     *
     * @ORM\Column(name="TransportId", type="integer",  nullable=true)
     */
    private $TransportId;

    /**
     * @return int
     */
    public function getTransportId()
    {
        return $this->TransportId;
    }

    /**
     * @param int $TransportId
     */
    public function setTransportId($TransportId)
    {
        $this->TransportId = $TransportId;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->UserId;
    }

    /**
     * @param int $UserId
     */
    public function setUserId($UserId)
    {
        $this->UserId = $UserId;
    }

    /**
     * @return int
     */
    public function getIdJoindreTransport()
    {
        return $this->idJoindreTransport;
    }

    /**
     * @param int $idJoindreTransport
     */
    public function setIdJoindreTransport($idJoindreTransport)
    {
        $this->idJoindreTransport = $idJoindreTransport;
    }
}