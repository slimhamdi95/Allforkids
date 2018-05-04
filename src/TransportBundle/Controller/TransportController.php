<?php

namespace TransportBundle\Controller;

use TransportBundle\Entity\JoindreTransport;
use TransportBundle\Entity\Transport;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TransportBundle\TransportBundle;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Transport controller.
 *
 */
class TransportController extends Controller
{
    /**
     * Lists all transport entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $transports = $em->getRepository('TransportBundle:Transport')->findAll();

        return $this->render('transport/index.html.twig', array(
            'transports' => $transports,
        ));
    }
    /**
     * participer au transport.
     *
     */
    public function joindreAction($idTransport){
        $em=$this->getDoctrine()->getManager();
        $user = $this->getUser()->getId();
        $pe = new JoindreTransport();
        $pe->setTransportId($idTransport);
        $pe->setUserId($user);
        $basic  = new \Nexmo\Client\Credentials\Basic('2762edea', '5lnvjtGSQEGFtdne');
        $client = new \Nexmo\Client($basic);
        $transport = $em->getRepository(Transport::class)->find($idTransport);
        $place = $transport->getPlace();
        $nbrplace = intval($place);
        $nbrplace = $nbrplace - 1 ;
        $transport->setPlace($nbrplace);
        $message = $client->message()->send([
           'to' => $transport->getTelephone(),
            'from' => 'Acme Inc',
           'text' => 'un nouveau membre a rejoindre votre covoiturage '
        ]);
        $em->persist($pe);
        $em->flush();

        return $this->redirectToRoute('transport_index');
    }

    /**
     * annuler participation.
     *
     */
    public function annulJoindreAction($idTransport){
        $em=$this->getDoctrine()->getManager();
        $user = $this->getUser()->getId();
        $em->getRepository('TransportBundle:JoindreTransport')-> AnnuleJoindre($idTransport,$user);
        $this->addFlash(
            'notice',
            'succès!'
        );

        return $this->redirectToRoute('transport_index',array('id'=>$idTransport));
    }

    /**
     * Lists all user transport entities.
     *
     */
    public function myTransportAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser()->getId();
        $transports = $em->getRepository('TransportBundle:Transport')->findBy(array('idCreateur' => $user));

        return $this->render('transport/myTransport.html.twig', array(
            'transports' => $transports,
        ));
    }

    public function rechercheDepartAction (Request $request){
        $em = $this->getDoctrine()->getManager();
        $transports = $em->getRepository('TransportBundle:Transport')->findAll();
        if ($request->isMethod('POST')){
            $departname=$request->get('departname');
            $transports=$em->getRepository('TransportBundle:Transport')->findBy(array('departname' => $departname));
        }
        return $this->render('transport/recherche.html.twig', array(
            'transports' => $transports,
        ));
    }

    /**
     * Lists all user rejoindre entities.
     *
     */
    public function myRejoindreAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser()->getId();
        $transportRejoindre = $em->getRepository('TransportBundle:JoindreTransport')->findListTransportjoindre($user);
        $idtransport = $transportRejoindre->getTransportId();
        $transport = $em->getRepository('TransportBundle:Transport')->findTransport($idtransport);

        return $this->render('transport/myRejoindre.html.twig', array(
            'transports' => $transport,
        ));
    }


    /**
     * Creates a new transport entity.
     *
     */
    public function newAction(Request $request)
    {
        $transport = new Transport();


        $form = $this->createForm('TransportBundle\Form\TransportType', $transport);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $transport = $form -> getData();
            $user = $this->getUser()->getId();
            $transport->setIdCreateur($user);

            $em->persist($transport);
            $em->flush();

            return $this->redirectToRoute('transport_show', array('idTransport' => $transport->getIdtransport()));
        }

        return $this->render('transport/new.html.twig', array(
            'transport' => $transport,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a transport entity.
     *
     */
    public function showAction(Transport $transport)
    {
        $deleteForm = $this->createDeleteForm($transport);
        $user = $this->getUser()->getId();
        return $this->render('transport/show.html.twig', array(
            'transport' => $transport,
            'delete_form' => $deleteForm->createView(),
            'user' => $user,
        ));
    }



    /**
     * Displays a form to edit an existing transport entity.
     *
     */
    public function editAction(Request $request, Transport $transport)
    {
        $deleteForm = $this->createDeleteForm($transport);
        $editForm = $this->createForm('TransportBundle\Form\TransportType', $transport);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('transport_edit', array('idTransport' => $transport->getIdtransport()));
        }

        return $this->render('transport/edit.html.twig', array(
            'transport' => $transport,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a transport entity.
     *
     */
    public function deleteAction(Request $request, Transport $transport)
    {
        $form = $this->createDeleteForm($transport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($transport);
            $em->flush();
        }

        return $this->redirectToRoute('transport_index');
    }

    /**
     * Creates a form to delete a transport entity.
     *
     * @param Transport $transport The transport entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Transport $transport)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('transport_delete', array('idTransport' => $transport->getIdtransport())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /****Mobile Service ******/
    public function AllranAction()
    {
        $em = $this->getDoctrine()->getManager();
        $transport = $em->gTetRepository('TransportBundle:Transport')->findAll();
        $ser = new Serializer([new ObjectNormalizer()]);
        $formatted = $ser->normalize($transport);
        return new JsonResponse($formatted);
    }

    public function findTranAction($idTransport)
    {
        $em = $this->getDoctrine()->getManager();
        $transport = $em->getRepository('TransportBundle:Transport')->find($idTransport);
        $ser = new Serializer([new ObjectNormalizer()]);
        $formated = $ser->normalize($transport);
        return new JsonResponse($formated);
    }

    public function newMobileAction($user,$description,$telephone,$place,$frais,$type){
        $em = $this->getDoctrine()->getManager();
        $transport = new Transport();
        $user =(int)$user;
        $transport->setDescription($description);
        $transport->setTelephone($telephone);
        $transport->setPlace($place);
        $transport->setFrais($frais);
        $transport->setType($type);
        $u = $em->getRepository('AllForKidsEntityBundle:User')->find($user);
        $transport->setIdCreateur($u);
        $em->persist($transport);
        $em->flush();
        $ser = new Serializer([new ObjectNormalizer()]);
        $formated = $ser->normalize($transport);
        return new JsonResponse($formated);
    }

    public function joindreMobileAction($id,$iduser){
        $em = $this->getDoctrine()->getManager();
        $joindre = new JoindreTransport();
        $joindre->setTransportId($id);
        $joindre->setUserId($iduser);
        $em->persist($joindre);
        $em->flush();
        $ser = new Serializer([new ObjectNormalizer()]);
        $formated = $ser->normalize($joindre);
        return new JsonResponse($formated);
    }

    public function deleteMobileAction($id){
        $em = $this->getDoctrine()->getManager();
        $transport= $em->getRepository(Transport::class)->find($id);
        $em->remove($transport);
        $em->flush();
        $pe="Deleting succsess" ;
        $ser = new Serializer([new ObjectNormalizer()]);
        $formated = $ser->normalize($pe);
        return new JsonResponse($formated);
    }

    public function myRejoindreMobileAction($iduser)
    {
        $em = $this->getDoctrine()->getManager();
        $transportRejoindre = $em->getRepository('TransportBundle:JoindreTransport')->findListTransportjoindre($iduser);
        $idtransport = $transportRejoindre->getTransportId();
        $transport = $em->getRepository('TransportBundle:Transport')->findTransport($idtransport);
        $ser = new Serializer([new ObjectNormalizer()]);
        $formatted = $ser->normalize($transport);
        return new JsonResponse($formatted);
        echo(hello);
    }

    public function AllranAction()
    {
        $em = $this->getDoctrine()->getManager();
        $transport = $em->gTetRepository('TransportBundle:Transport')->findAll();
        $ser = new Serializer([new ObjectNormalizer()]);
        $formatted = $ser->normalize($transport);
        return new JsonResponse($formatted);
    }

}
