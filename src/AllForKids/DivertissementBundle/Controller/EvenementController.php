<?php

namespace AllForKids\DivertissementBundle\Controller;

use AllForKids\DivertissementBundle\ImageUpload;
use AllForKids\EntityBundle\Entity\Evenement;
use AllForKids\EntityBundle\Entity\Participevenement;
use AllForKids\EntityBundle\Form\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile ;
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

            $ev->setPhoto($fileName);
            $ev->setIdUser($this->getUser());
            $em=$this->getDoctrine()->getManager();
            $em->persist($ev);

            $em->flush();
            return $this->redirectToRoute("afficheE");
        }

        return $this->render('AllForKidsDivertissementBundle:Evenement:ajout.html.twig', array('form'=>$form->createView()));

    }
   public function ShowAction($id){

       $em=$this->getDoctrine()->getManager();
       $ev=$em->getRepository('AllForKidsEntityBundle:Evenement')->find($id);
       $pe = $em->getRepository('AllForKidsEntityBundle:Participevenement')->findDqlParticipE($id,$this->getUser()->getId());
       $us = $ev->getIdUser()->getId();
       $v= false ;
       if($us == $this->getUser()->getId()){
           $v= true ;
       }
       $verif= true ;
       if($pe == null ){
           $verif = false;
       }
       $a= $ev->getIdUser()->getId();
       $u=$em->getRepository('AllForKidsEntityBundle:User')->find($a);
       $nb = $em->getRepository('AllForKidsEntityBundle:Participevenement')->findDqlNbParticipE($id);

      $nb = $ev->getNbrParticipation()- $nb ;
      
       return $this->render('AllForKidsDivertissementBundle:Evenement:Show.html.twig',
           array(
               'e'=>$ev,
               'u'=>$u,
               'pe'=>$verif,
               'v'=>$v,
               'nb'=>$nb

           ));
   }
   public function ParticipAction($id){

       $em=$this->getDoctrine()->getManager();
       $pe = new Participevenement();
        $pe->setIdEvenement($id);
        $pe->setIdUser($this->getUser()->getId());
        $em->persist($pe);
       $em->flush();
       $this->addFlash(
           'notice',
           'Votre reservation est enregistre avec succès!'
       );

       return $this->redirectToRoute('DetailE',array('id'=>$id));
   }
   public function AnulParticipAction( $id){
       $em=$this->getDoctrine()->getManager();
       $em->getRepository('AllForKidsEntityBundle:Participevenement')-> DeleteDqlParticipE($id,$this->getUser()->getId());
       $this->addFlash(
           'notice',
           'Votre reservation est Annuler avec succès!'
       );

       return $this->redirectToRoute('DetailE',array('id'=>$id));
   }
   public function MyEventAction(){
       $em=$this->getDoctrine()->getManager();
       $evenement=$em->getRepository('AllForKidsEntityBundle:Evenement')->findBy(
           ['idUser' => $this->getUser()]

       );

       return $this->render('AllForKidsDivertissementBundle:Evenement:Mayevent.html.twig',
           array(
               'e'=>$evenement
           ));
   }
   public function SemainEventAction(){
       $em=$this->getDoctrine()->getManager();
       $evenement=$em->getRepository('AllForKidsEntityBundle:Evenement')->findDqlSemaine();

       return $this->render('AllForKidsDivertissementBundle:Evenement:SemainEvent.html.twig',
           array(
               'e'=>$evenement
           ));
   }
   public function MesEventInscAction(){
       $em=$this->getDoctrine()->getManager();
       $evenement=$em->getRepository('AllForKidsEntityBundle:Evenement')->findDqlInscrit($this->getUser()->getId());

       return $this->render('AllForKidsDivertissementBundle:Evenement:MesEventIns.html.twig',
           array(
               'e'=>$evenement
           ));
   }

}
