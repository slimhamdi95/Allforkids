<?php
/**
 * Created by PhpStorm.
 * User: slim
 * Date: 10/04/2018
 * Time: 21:41
 */

namespace AllForKids\EntityBundle\Repository;


class LivreRepository extends \Doctrine\ORM\EntityRepository
{
    public function findDqlCategorie($a,$b)
    {
        $q=$this->getEntityManager()
            ->createQuery("select lv FROM AllForKidsEntityBundle:Livre lv WHERE lv.categorie LIKE :a
                    AND lv.type LIKE :b  ")
            ->setParameter('a','%'.$a.'%')
            ->setParameter('b','%'.$b.'%');
        return $q->getResult();

    }
}