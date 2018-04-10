<?php
/**
 * Created by PhpStorm.
 * User: slim
 * Date: 09/04/2018
 * Time: 16:42
 */

namespace AllForKids\DivertissementBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AllForKids\EntityBundle\Entity\starratingsystem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;

class AjaxStarratingsystemController extends Controller
{
    public function updateDataAction(Request $request)
    {
        $mediaId = $request->get('mediaId');
        $rate = $request->get('rate');

        $em = $this->getDoctrine()->getManager();

        $rateExists = $em->createQuery('SELECT s.id FROM AllForKidsEntityBundle:starratingsystem s WHERE s.media = :media')
            ->setParameter('media', $mediaId)
            ->getResult();

        if ($rateExists != null) {
            $q = $em->createQuery('UPDATE AllForKidsEntityBundle:starratingsystem s SET s.rate = s.rate + '.$rate.', s.nbrrate = s.nbrrate + 1 WHERE s.media = ?1')
                ->setParameter(1, $mediaId);
            $q->execute();
        } else {
            $newRate = new starratingsystem;
            $newRate->setMedia($mediaId);
            $newRate->setRate($rate);
            $newRate->setNbrrate(1);
            $em->persist($newRate);
            $em->flush();
        }
        $query = $em->createQuery('SELECT s.rate, s.nbrrate FROM AllForKidsEntityBundle:starratingsystem s WHERE s.media = :media')
            ->setParameter('media', $mediaId);
        $result = $query->getResult();

        $response = new JsonResponse();
        $response->setData(array('avg' => round($result[0]['rate'] / $result[0]['nbrrate'], 2), 'nbrRate' => $result[0]['nbrrate']));
        return $response;
    }
}