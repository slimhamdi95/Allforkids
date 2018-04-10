<?php

namespace AllForKidsLiverBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AllForKids\EntityBundle\Entity\Livre;
use AllForKids\EntityBundle\Form\LivreType;
use AllForKids\DivertissementBundle\ImageUpload;
class LiverController extends Controller
{
    public function ShowAllAction(Request $request){



        $em=$this->getDoctrine()->getManager();
        $evenement=$em->getRepository('AllForKidsEntityBundle:Livre')->findAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $evenement, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 6)/*limit per page*/
        );
        return $this->render('AllForKidsLiverBundle:Liver:ShowAll.html.twig',
            array(
                'l' => $pagination
            ));

    }
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function AddAction(Request $request){
        $lv =new Livre();

        $form=$this->createForm(LivreType::class,$lv,array('required'=>true));
        $form->handleRequest($request);

        if ($form->isValid()){

            $file = new ImageUpload($this->getParameter('images_directory'));
            $file2 = new  ImageUpload($this->getParameter('images_directory'));
            $fileName = $file->upload($lv->getPhoto());
             $fileName2 = $file->upload($lv->getUrl());
            $lv->setPhoto($fileName);
            $lv->setUrl($fileName2);
            $lv->setGood(0);
            $lv->setBad(0);


            $em=$this->getDoctrine()->getManager();
            $em->persist($lv);

            $em->flush();
            return $this->redirectToRoute("AffichLiver");
        }

        return $this->render('AllForKidsLiverBundle:Liver:Ajout.html.twig', array('form'=>$form->createView()));

    }
}
