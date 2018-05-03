<?php
/**
 * Created by PhpStorm.
 * User: slim
 * Date: 03/04/2018
 * Time: 11:52
 */

namespace AllForKids\EntityBundle\Repository;


class ParticipevenementRepository extends \Doctrine\ORM\EntityRepository
{
    public function findDqlParticipE($a,$b)
    {
        $q=$this->getEntityManager()
            ->createQuery("select pe FROM AllForKidsEntityBundle:Participevenement pe WHERE pe.idEvenement = :a
                            AND pe.idUser = :id_user")
            ->setParameter('a',$a)
            ->setParameter('id_user',$b);
        return $q->getResult();

    }
    public function DeleteDqlParticipE($a,$b)
    {
        $q=$this->getEntityManager()
            ->createQuery("delete  FROM AllForKidsEntityBundle:Participevenement pe WHERE pe.idEvenement = :a
                            AND pe.idUser = :id_user")
            ->setParameter('a',$a)
            ->setParameter('id_user',$b);
        $q->execute();

    }
    public function findDqlNbParticipE($a)
    {
        $q=$this->getEntityManager()
            ->createQuery("select COUNT(pe) FROM AllForKidsEntityBundle:Participevenement pe WHERE pe.idEvenement = :a")
            ->setParameter('a',$a);

        return $q->getSingleScalarResult();

    }
}