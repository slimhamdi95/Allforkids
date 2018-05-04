<?php

namespace AllForKids\EntityBundle\Controller;

use AllForKids\EntityBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntityValidator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AllForKidsEntityBundle:Default:layout.html.twig');
    }



    /************* service user mobile **************************/



    public function FindByLoginAction($userName)
    {
        $em = $this->getDoctrine()->getManager();
        $ev = $em->getRepository('AllForKidsEntityBundle:User')->findOneBy(['username' => $userName]);
        $date = $ev->getDate();
        $result = $date->format('Y-m-d');
        $ev->setDate($result);
        $ser = new Serializer([new ObjectNormalizer()]);
        $formated = $ser->normalize($ev);
        return new JsonResponse($formated);
    }


    public function FindAllUserAction()
    {
        /*  $em = $this->getDoctrine()->getManager();

          $ev = $em->getRepository('AllForKidsEntityBundle:User')->findAll();

          $a = new ArrayCollection();
          foreach($ev as $e)
          {
              $a->add($e->getUsername());
          }*/
        $sql = $this->getDoctrine()->getConnection();
        $query = $sql->prepare('SELECT username FROM user');
        $query->execute();
        $formated = $query->fetchAll();
        $ser = new Serializer([new ObjectNormalizer()]);
        $fs = $ser->normalize($formated);
        return new JsonResponse($fs);
    }


   public function InscritAction ( $username, $nom , $prenom , $role ,$email , $cin , $password,$date ,$photo){
           $em = $this->getDoctrine()->getManager();
           $ev = new User();
           $ev->setUsername($username);
           $ev->setNom($nom);
           $ev->setPrenom($prenom);
           $ev->setRole($role);
           $ev->setEmail($email);
           $ev->setCin($cin);


       $d = new \DateTime($date);
       $ev->setDate($d);
       $ev->setPicture($photo);
       $encoder = $this->container->get('security.encoder_factory')->getEncoder($ev);

       $ev->setPassword($encoder->encodePassword($password, $ev->getSalt()));

       $em->persist($ev);
           $em->flush();

           $ser = new Serializer([new ObjectNormalizer()]);
           $formated = $ser->normalize($ev);

           return new JsonResponse($formated);
       }



    public function InscritRAction ( $username, $nom , $prenom , $role ,$email , $cin , $password,$date ,$photo){

        $em = $this->getDoctrine()->getManager();
        $ev = new User();
        $ev->setUsername($username);
        $ev->setNom($nom);
        $ev->setPrenom($prenom);
        $ev->setRole($role);
        $ev->setEmail($email);
        $ev->setCin($cin);
        $ev->setPassword($password);

        $d = new \DateTime($date);
        $ev->setDate($d);
        $ev->setPhoto($photo);

        $em->persist($ev);
        $em->flush();

        $ser = new Serializer([new ObjectNormalizer()]);
        $formated = $ser->normalize($ev);

        return new JsonResponse($formated);
    }


    public function ModifierAction ($id, $username, $nom , $prenom , $role ,$email , $cin , $password,$date ,$photo){

        $em = $this->getDoctrine()->getManager();
        $ev = $em->getRepository('AllForKidsEntityBundle:User')->find($id);
        $ev->getUsername($username);
        $ev->getNom($nom);
        $ev->getPrenom($prenom);
        $ev->getRole($role);
        $ev->getEmail($email);
        $ev->getCin($cin);
        $ev->getPassword($password);

        $d = new \DateTime($date);
        $ev->getDate($d);
        $ev->setPicture($photo);

        $ev->flush();

        $ser = new Serializer([new ObjectNormalizer()]);
        $formated = $ser->normalize($ev);

        return new JsonResponse($formated);
    }




}
