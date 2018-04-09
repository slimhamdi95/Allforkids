<?php

namespace TransportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    public function loginAction()
    {
        return $this->render('TransportBundle:Security:login.html.twig', array(
            // ...
        ));
    }

    public function logoutAction()
    {
        return $this->render('TransportBundle:Security:logout.html.twig', array(
            // ...
        ));
    }


}
