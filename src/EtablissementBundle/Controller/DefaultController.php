<?php

namespace EtablissementBundle\Controller;

use EtablissementBundle\Entity\Etablissement;
use EtablissementBundle\Entity\Note;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class DefaultController extends Controller
{


    /****Mobile Service ******/
    public function all1Action()
    {

        $em = $this->getDoctrine()->getManager();
        $etablissement = $em->getRepository('EtablissementBundle:Etablissement')->findAll();
        $ser = new Serializer([new ObjectNormalizer()]);
        $formated = $ser->normalize($etablissement);
        return new JsonResponse($formated);

    }

    public function find1Action($id)
    {

        $em = $this->getDoctrine()->getManager();
        $ev = $em->getRepository('EtablissementBundle:Etablissement')->find($id);
        $ser = new Serializer([new ObjectNormalizer()]);
        $formated = $ser->normalize($ev);
        return new JsonResponse($formated);
    }



    public function new1Action($user,$nom,$type,$region,$ville,$description,$image,$verification){
        $em = $this->getDoctrine()->getManager();
        $ev = new Etablissement();
        $user =(int)$user;
        $ev->setNom($nom);
        $ev->setDescription($description);
        $ev->setType($type);
        $region=(int)$region;
        $ville=(int)$ville;
        $ev->setImage($image);
        $ev->setVerification($verification);

        $a= $em->getRepository('EtablissementBundle:Region')->find($region);
        $b= $em->getRepository('EtablissementBundle:Ville')->find($ville);
        $ev->setVille($b->getNomVille());
        $u = $em->getRepository('AllForKidsEntityBundle:User')->find($user);
        $ev->setIdUser($u);
        $ev->setRegion($a);
       // $ev->setVille($b);


        $em->persist($ev);
        $em->flush();

        $ser = new Serializer([new ObjectNormalizer()]);
        $formated = $ser->normalize($ev);
        return new JsonResponse($formated);
    }

//////////////////////////SYMFONY/////////////////

    public function indexAction()
    {
        return $this->render('EtablissementBundle:Default:index.html.twig');
    }

    public function elevesAction(\Symfony\Component\HttpFoundation\Request $request){
        $eleves = [];
        $em = $this->getDoctrine()->getManager();
        $etab =  $em->getRepository('EtablissementBundle:Etablissement')->find($request->get('idetab'));
        $rejs =  $etab->getRejoindres();
        foreach ($rejs as $rej){
            array_push($eleves,['user'=>$rej->getUser(),"verif"=>$rej->getVerification(),'rej'=>$rej->getId()]);
        }
        return $this->render('etablissement/eleves.html.twig',['eleves'=>$eleves]);
    }

    public function elevesvalAction(\Symfony\Component\HttpFoundation\Request $request){
        $em =  $this->getDoctrine()->getManager();
        $rej = $em->getRepository('EtablissementBundle:Rejoindre')->findOneBy(['id'=>$request->get('id')]);
        $rej->setVerification('Valide');
        $em->flush();
        return $this->redirectToRoute('liste_eleves',['idetab'=>$rej->getEtablissement()->getIdEtablissement()]);
    }

    public function noteAction(\Symfony\Component\HttpFoundation\Request $request){
        $note = new Note();
        $em =  $this->getDoctrine()->getManager();
        $matieres = $em->getRepository('EtablissementBundle:Matiere')->findAll();
        $eleve = $em->getRepository('AllForKidsEntityBundle:User')->find($request->get('idelev'));

        if ($request->get('submit') ) {

            foreach ($matieres as  $matiere){
                $note = new Note();
                $note->setNote(floatval($request->get('note_'.$matiere->getNomMatiere())));
                $note->setMatiere($matiere);
                $note->setUser($eleve);
                $em->persist($note);
                $em->flush($note);

            }

            return $this->redirectToRoute('homepage');
        }

        return $this->render('etablissement/noter.html.twig', array(
            'matieres'=>$matieres,
           'idelev'=>$eleve->getId()

        ));
    }

    public function moyenneAction(\Symfony\Component\HttpFoundation\Request $request){


        $sommecoef=0;
        $sommenote=0;
        $notes = $this->getUser()->getNotes();
        foreach ($notes as $note){
            $sommecoef+= $note->getMatiere()->getCoeff();
            $sommenote+= ($note->getNote() * $note->getMatiere()->getCoeff() );
        }
        if($sommecoef==0){
            $this->addFlash('erreur','notes non saisis');
            $moyenne=-1;
        }
        else{
            $moyenne = $sommenote/$sommecoef;
        }

        if($request->get('pdf')){
            $snappy = $this->get('knp_snappy.pdf');

            $html = $this->renderView('etablissement/notepdf.html.twig', array(
                'notes'=>$notes,
                'moyenne'=>$moyenne
            ));

            $filename = 'Resultat';

            return new Response(
                $snappy->getOutputFromHtml($html),
                200,
                array(
                    'Content-Type'          => 'application/pdf',
                    'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
                )
            );
        }
        return  $this->render('etablissement/lesnotes.html.twig', array(
            'notes'=>$notes,
            'moyenne'=>$moyenne
        ));

/*
        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            'file.pdf'
        );*/

    }
}
