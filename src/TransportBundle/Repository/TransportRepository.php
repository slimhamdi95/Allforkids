<?php

/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 08/04/2018
 * Time: 19:28
 */
namespace TransportBundle\Repository;

class TransportRepository extends Doctrine\ORM\EntityRepository
{
    public function findTransport($idtransport)
    {
        $listTransport=$this->getEntityManager()->createQuery("
            select t FROM TransportBunde:Transport t 
            WHERE t.idTransport = :idtransport")
            ->setParameter('idtransport',$idtransport)->getResult();

        return $listTransport;
    }
}