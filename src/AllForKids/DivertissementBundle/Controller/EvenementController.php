<?php

namespace AllForKids\DivertissementBundle\Controller;

use AllForKids\DivertissementBundle\ImageUpload;
use AllForKids\EntityBundle\Entity\Evenement;
use AllForKids\EntityBundle\Entity\Participevenement;
use AllForKids\EntityBundle\Form\EvenementType;
use AllForKids\EntityBundle\Form\EvenmentUpdateType;
use AllForKids\EntityBundle\Form\RechercheEventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile ;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\Date ;
class EvenementController extends Controller
{
    public function ShowAllAction(Request $request)
    {

        if ($request->isMethod('POST')) {
            $nom = $request->get('re');
            return $this->redirectToRoute("Recherche", array('nom' => $nom));
        }

        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository('AllForKidsEntityBundle:Evenement')->findAll();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $evenement, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 2)/*limit per page*/
        );
        return $this->render('AllForKidsDivertissementBundle:Evenement:ShowAll.html.twig',
            array(
                'e' => $pagination
            ));

    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function AddAction(Request $request)
    {
        $ev = new Evenement();

        $form = $this->createForm(EvenementType::class, $ev, array('required' => true));
        $form->handleRequest($request);

        if ($form->isValid()) {

            $file = new ImageUpload($this->getParameter('images_directory'));

            $fileName = $file->upload($ev->getPhoto());

            $ev->setPhoto($fileName);
            $ev->setIdUser($this->getUser());
            $ev->setLatitude($request->get('lat'));
            $ev->setLongitude($request->get('lng'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($ev);

            $em->flush();
            return $this->redirectToRoute("afficheE");
        }

        return $this->render('AllForKidsDivertissementBundle:Evenement:ajout.html.twig', array('form' => $form->createView()));

    }

    public function ShowAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $ev = $em->getRepository('AllForKidsEntityBundle:Evenement')->find($id);
        $pe = $em->getRepository('AllForKidsEntityBundle:Participevenement')->findDqlParticipE($id, $this->getUser()->getId());
        $us = $ev->getIdUser()->getId();
        $v = false;
        if ($us == $this->getUser()->getId()) {
            $v = true;
        }
        $verif = true;
        if ($pe == null) {
            $verif = false;
        }
        $a = $ev->getIdUser()->getId();
        $u = $em->getRepository('AllForKidsEntityBundle:User')->find($a);
        $nb = $em->getRepository('AllForKidsEntityBundle:Participevenement')->findDqlNbParticipE($id);

        $nb = $ev->getNbrParticipation() - $nb;

        return $this->render('AllForKidsDivertissementBundle:Evenement:Show.html.twig',
            array(
                'e' => $ev,
                'u' => $u,
                'pe' => $verif,
                'v' => $v,
                'nb' => $nb

            ));
    }

    public function ParticipAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $pe = new Participevenement();
        $pe->setIdEvenement($id);
        $pe->setIdUser($this->getUser()->getId());
        $em->persist($pe);
        $em->flush();
        $this->addFlash(
            'notice',
            'Votre reservation est enregistre avec succès!'
        );

        return $this->redirectToRoute('DetailE', array('id' => $id));
    }

    public function AnulParticipAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->getRepository('AllForKidsEntityBundle:Participevenement')->DeleteDqlParticipE($id, $this->getUser()->getId());
        $this->addFlash(
            'notice',
            'Votre reservation est Annuler avec succès!'
        );

        return $this->redirectToRoute('DetailE', array('id' => $id));
    }

    public function MyEventAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $nom = $request->get('re');
            return $this->redirectToRoute("Recherche", array('nom' => $nom));
        }

        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository('AllForKidsEntityBundle:Evenement')->findBy(
            ['idUser' => $this->getUser()]

        );
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $evenement, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 2)/*limit per page*/
        );

        return $this->render('AllForKidsDivertissementBundle:Evenement:Mayevent.html.twig',
            array(
                'e' => $pagination
            ));
    }

    public function SemainEventAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $nom = $request->get('re');
            return $this->redirectToRoute("Recherche", array('nom' => $nom));
        }
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository('AllForKidsEntityBundle:Evenement')->findDqlSemaine();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $evenement, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 6)/*limit per page*/
        );

        return $this->render('AllForKidsDivertissementBundle:Evenement:SemainEvent.html.twig',
            array(
                'e' => $pagination
            ));
    }

    public function MesEventInscAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $nom = $request->get('re');
            return $this->redirectToRoute("Recherche", array('nom' => $nom));
        }
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository('AllForKidsEntityBundle:Evenement')->findDqlInscrit(
            $this->getUser()->getId());
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $evenement, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 6)/*limit per page*/
        );
        return $this->render('AllForKidsDivertissementBundle:Evenement:MesEventInsc.html.twig',
            array(
                'e' => $pagination
            ));
    }

    public function RecherchAction(Request $request, $nom)
    {
        if ($request->isMethod('POST')) {
            $nom = $request->get('re');
            return $this->redirectToRoute("Recherche", array('nom' => $nom));
        }
        $em = $this->getDoctrine();
        $evs = $em->getRepository(Evenement::class)
            ->findDqlNomParametre($nom);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $evs, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 6)/*limit per page*/
        );

        return $this->render('AllForKidsDivertissementBundle:Evenement:Recherche.html.twig',
            array('e' => $pagination)
        );
    }

    public function DeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $ev = $em->getRepository(Evenement::class)->find($id);
        $em->remove($ev);
        $em->flush();
        return $this->redirectToRoute('afficheE');
    }

    public function UpdateAction(Request $request, $id)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine();
        $e = $em->getRepository(Evenement::class)->find($id);
        $img = $e->getPhoto();
        $e->setPhoto(null);
        $form = $this->createForm(EvenmentUpdateType::class, $e);
        $form->handleRequest($request);

        if ($form->isValid()) {
            if ($e->getPhoto() == null) {

                $e->setPhoto($img);
            } else {
                $file = new ImageUpload($this->getParameter('images_directory'));

                $fileName = $file->upload($e->getPhoto());

                $e->setPhoto($fileName);
            }
            $e->setLatitude($request->get('lat'));
            $e->setLongitude($request->get('lng'));
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("MyEvent");
        }
        return $this->render('AllForKidsDivertissementBundle:Evenement:update.html.twig', array('form' => $form->createView(), 'e' => $e));

    }

    public function SupprimerDAction()
    {
        $em = $this->getDoctrine()->getManager();
        $em->getRepository('AllForKidsEntityBundle:Evenement')->DeleteDqlDep();
        $this->addFlash(
            'notice',
            'Evenements Supprimer  avec succès!'
        );

        return $this->redirectToRoute('afficheE');
    }

    /**
     * @param $data
     * @return null|UploadedFile
     */
    public function reverseTransform($data)
    {
        if (!$data) {
            return null;
        }

        $path = $data['tmp_name'];
        $pathinfo = pathinfo($path);
        $basename = $pathinfo['basename'];

        try {
            $uploadedFile = new UploadedFile(
                $path,
                $basename,
                $data['type'],
                $data['size'],
                $data['error']
            );
        } catch (FileNotFoundException $ex) {
            throw new TransformationFailedException($ex->getMessage());
        }

        return $uploadedFile;
    }

    public function ShowAllAdminAction(Request $request)
    {

        if ($request->isMethod('POST')) {
            $nom = $request->get('re');
            return $this->redirectToRoute("Recherche", array('nom' => $nom));
        }

        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository('AllForKidsEntityBundle:Evenement')->findAll();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $evenement, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 6)/*limit per page*/
        );
        return $this->render('AllForKidsDivertissementBundle:Evenement:ShowAllAdminEvent.html.twig',
            array(
                'e' => $pagination
            ));

    }

    /****Mobile Service ******/
    public function AllevAction()
    {

        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository('AllForKidsEntityBundle:Evenement')->findAll();
        $ser = new Serializer([new ObjectNormalizer()]);
        $formated = $ser->normalize($evenement);
        return new JsonResponse($formated);

    }

    public function ShowMobilAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $ev = $em->getRepository('AllForKidsEntityBundle:Evenement')->find($id);
        $ser = new Serializer([new ObjectNormalizer()]);
        $formated = $ser->normalize($ev);
        return new JsonResponse($formated);
    }
    public function newAction($nom,$description,$date,$nb,$type,$temp,$photo,$user,$lat,$lng){
        $em = $this->getDoctrine()->getManager();
        $ev = new Evenement();
        $ev->setNom($nom);
        $ev->setDescriptionn($description);
        $ev->setNbrParticipation($nb);
         $d = new \DateTime($date);
        // $d->setDate();
        $ev->setDate($d);
        $ev->setType($type);
        $d = new \DateTime($temp);
        $ev->setTemp($d);
        $ev->setPhoto($photo);
        $user =(int)$user;
        $u = $em->getRepository('AllForKidsEntityBundle:User')->find($user);
        $ev->setIdUser($u);
        $ev->setLatitude($lat);
        $ev->setLongitude($lng);

        $em->persist($ev);
        $em->flush();

        $ser = new Serializer([new ObjectNormalizer()]);
        $formated = $ser->normalize($ev);

        return new JsonResponse($formated);
    }
}