<?php

namespace EtablissementBundle\Controller;

use Doctrine\ORM\Query;
use EtablissementBundle\Entity\Etablissement;
use EtablissementBundle\Entity\Rejoindre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


/**
 * Etablissement controller.
 *
 */
class EtablissementController extends Controller
{
    /**
     * Lists all etablissement entities.
     *
     */

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if($this->isGranted('ROLE_ADMIN')){

            $etablissements = $em->getRepository('EtablissementBundle:Etablissement')->findAll();

        }else if($this->isGranted('ROLE_RESPONSABLE')){
            $etablissements = $em->getRepository('EtablissementBundle:Etablissement')->findby(['idUser'=>$this->getUser()->getId()]);

        }
        else{
            $etablissements = $em->getRepository('EtablissementBundle:Etablissement')->findby(['verification'=>'Valide']);
        }





        return $this->render('etablissement/index.html.twig', array(
            'etablissements' => $etablissements,
        ));

    }


    public function infoAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) // pour vérifier la présence d'une requete Ajax
        {

            $id = $request->request->get('id');//recevoir l'id de la direction
            if ($id != null) {
              $agences = $this->getDoctrine()
                  ->getRepository('EtablissementBundle:Ville')
                ->getVilles($id);

                if($agences){
                    return  new JsonResponse ($agences);
                }
                else{
                    return  new JsonResponse(null);
                }
            }
        }
        return new JsonResponse(json_encode(null));
    }


    /**
     * Creates a new etablissement entity.
     *
     */
    public function newAction(Request $request)
    {
        $etablissement = new Etablissement();
        $form = $this->createForm('EtablissementBundle\Form\EtablissementType', $etablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $ville = $em->getRepository('EtablissementBundle:Ville')->find($request->get('villeselect'));
            $etablissement->setVille($ville->getNomVille());
            $etablissement->setIdUser($this->getUser());
            $em->persist($etablissement);
            $em->flush();

            return $this->redirectToRoute('etablissement_show', array('idEtablissement' => $etablissement->getIdetablissement()));
        }

        return $this->render('etablissement/new.html.twig', array(
            'etablissement' => $etablissement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a etablissement entity.
     *
     */
    public function showAction(Etablissement $etablissement)
    {
        $rej= false;
        $deleteForm = $this->createDeleteForm($etablissement);
        foreach ($etablissement->getRejoindres() as $rejoindre){
            if($rejoindre->getUser() === $this->getUser())
                $rej = true;
        }
        return $this->render('etablissement/show.html.twig', array(
            'etablissement' => $etablissement,
            'delete_form' => $deleteForm->createView(),
            'rej'=>$rej
        ));
    }

    /**
     * Displays a form to edit an existing etablissement entity.
     *
     */
    public function editAction(Request $request, Etablissement $etablissement)
    {
        $deleteForm = $this->createDeleteForm($etablissement);
        $editForm = $this->createForm('EtablissementBundle\Form\EtablissementType', $etablissement);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $etab = $em->getRepository('EtablissementBundle\Entity\Etablissement')->find($etablissement->getIdetablissement());
        if ($editForm->isSubmitted() ) {

            if($etablissement->getImage()== null){
                $etablissement->setImage($etab->getImage());
            }
            $etablissement->setVille($request->get('villeselect'));

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etablissement_show', array('idEtablissement' => $etablissement->getIdetablissement()));
        }

        return $this->render('etablissement/edit.html.twig', array(
            'etablissement' => $etablissement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a etablissement entity.
     *
     */
    public function deleteAction(Request $request, Etablissement $etablissement)
    {
        $form = $this->createDeleteForm($etablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($etablissement);
            $em->flush();
        }

        return $this->redirectToRoute('etablissement_index');
    }

    /**
     * Creates a form to delete a etablissement entity.
     *
     * @param Etablissement $etablissement The etablissement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Etablissement $etablissement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('etablissement_delete', array('idEtablissement' => $etablissement->getIdetablissement())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function validerAction(Request $request){
        $em =  $this->getDoctrine()->getManager();
        $etab = $em->getRepository('EtablissementBundle:Etablissement')->findOneBy(['idEtablissement'=>$request->get('idetab')]);
        $etab->setVerification('Valide');
        $em->flush();
        $path = $this->generateUrl('etablissement_show',['idEtablissement'=>$etab->getIdEtablissement()]);
        return $this->redirect($path);
    }
    public function rejoindreAction(Request $request){
        $rejoindre = new Rejoindre();
        $em =  $this->getDoctrine()->getManager();
        $etab = $em->getRepository('EtablissementBundle:Etablissement')->findOneBy(['idEtablissement'=>$request->get('idetab')]);
        $rejoindre->setEtablissement($etab);
        $rejoindre->setUser($this->getUser());
        $rejoindre->setVerification('Non valide');
        $em->persist($rejoindre);
        $em->flush($rejoindre);
        $path = $this->generateUrl('etablissement_show',['idEtablissement'=>$etab->getIdEtablissement()]);
        return $this->redirect($path);
    }
}
