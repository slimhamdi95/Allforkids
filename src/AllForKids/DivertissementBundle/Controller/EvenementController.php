<?php

namespace AllForKids\DivertissementBundle\Controller;

use AllForKids\DivertissementBundle\ImageUpload;
use AllForKids\EntityBundle\Entity\Evenement;
use AllForKids\EntityBundle\Form\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile ;
class EvenementController extends Controller
{
    public function ShowAllAction(){
        $em=$this->getDoctrine()->getManager();
        $evenement=$em->getRepository('AllForKidsEntityBundle:Evenement')->findAll();
       $a="product-img1.jpg" ;
        return $this->render('AllForKidsDivertissementBundle:Evenement:ShowAll.html.twig',
            array(
                'e'=>$evenement,'a'=>$a
            ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function AddAction(Request $request){
        $ev =new Evenement();
        $form=$this->createForm(EvenementType::class,$ev);
        $form->handleRequest($request);

        if ($form->isValid()){

            $file = new ImageUpload($this->getParameter('images_directory'));

            $fileName = $file->upload($ev->getPhoto());
            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $ev->setPhoto($fileName);
            $em=$this->getDoctrine()->getManager();
            $em->persist($ev);
            $em->flush();
            return $this->redirectToRoute("afficheE");
        }

        return $this->render('AllForKidsDivertissementBundle:Evenement:ajout.html.twig', array('form'=>$form->createView()));

    }

}
