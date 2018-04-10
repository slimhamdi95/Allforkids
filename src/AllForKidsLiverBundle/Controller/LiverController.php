<?php

namespace AllForKidsLiverBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AllForKids\EntityBundle\Entity\Livre;
use AllForKids\EntityBundle\Form\LivreType;
use AllForKids\DivertissementBundle\ImageUpload;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class LiverController extends Controller
{
    public function ShowAllAction(Request $request){

        if($request->isMethod('POST')){

            return $this->redirectToRoute("RechercheLiver");
        }

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
             $fileName2 = $file2->upload($lv->getUrl());
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
    public function ShowAction(Request $request,$id){
        $em=$this->getDoctrine();
        $lv = $em->getRepository(Livre::class)->find($id);
        return $this->render('AllForKidsLiverBundle:Liver:ShowLiver.html.twig', array(
            'lv'=>$lv
        ));
    }
    public function SearchDQLCategoriAction(Request $request){

            $categori = $request->get('categori');
            $typee = $request->get('typee');
            $em=$this->getDoctrine()->getManager();
            $liver=$em->getRepository('AllForKidsEntityBundle:Livre')
                   ->findDqlCategorie($categori,$typee);
            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $liver, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                $request->query->getInt('limit', 6)/*limit per page*/
            );

            return $this->render('AllForKidsLiverBundle:Liver:ShowCategoriLiver.html.twig',
                array(
                    'l'=>$pagination
                ));


    }
}
