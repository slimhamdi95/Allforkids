<?php

namespace TransportBundle\Controller;

use TransportBundle\Entity\JoindreTransport;
use TransportBundle\Entity\Transport;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TransportBundle\TransportBundle;

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
        //$basic  = new \Nexmo\Client\Credentials\Basic('2762edea', '5lnvjtGSQEGFtdne');
        //$client = new \Nexmo\Client($basic);
        $transport = $em->getRepository(Transport::class)->find($idTransport);
        $place = $transport->getPlace();
        $nbrplace = intval($place);
        $nbrplace = $nbrplace - 1 ;
        $transport->setPlace($nbrplace);
        //$message = $client->message()->send([
        //   'to' => $transport->getTelephone(),
        //    'from' => 'Acme Inc',
        //   'text' => 'A text message sent using the Nexmo SMS API'
        //]);
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
}
