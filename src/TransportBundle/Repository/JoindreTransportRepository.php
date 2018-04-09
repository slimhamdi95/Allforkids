<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 08/04/2018
 * Time: 23:15
 */

namespace TransportBundle\Repository;

class JoindreTransportRepository extends Doctrine\ORM\EntityRepository
{
    public function findListTransportjoindre($iduser)
    {
        $listJoindreTransport=$this->getEntityManager()->createQuery("
            select jt FROM TransportBunde:JoindreTransport jt 
            WHERE jt.UserId = :iduser")
            ->setParameter('iduser',$iduser)->getResult();

        return $listJoindreTransport;
    }

    public function AnnuleJoindre($a,$b)
    {
        $q=$this->getEntityManager()
            ->createQuery("delete  FROM TransportBundle:JoindreTransport jointran WHERE jointran.TransportId = :a
                            AND jointran.UserId = :id_user")
            ->setParameter('a',$a)
            ->setParameter('id_user',$b);
        $q->execute();

    }
}