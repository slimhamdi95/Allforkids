<?php

namespace AllForKids\DivertissementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EvenementController extends Controller
{
    public function ShowAllAction(){
        $em=$this->getDoctrine()->getManager();
        $evenement=$em->getRepository('AllForKidsEntityBundle:Evenement')->findAll();

        return $this->render('AllForKidsDivertissementBundle:Evenement:ShowAll.html.twig',
            array(
                'e'=>$evenement
            ));
    }
}
