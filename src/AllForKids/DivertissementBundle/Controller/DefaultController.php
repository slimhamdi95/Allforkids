<?php

namespace AllForKids\DivertissementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AllForKidsDivertissementBundle:Default:index.html.twig');
    }
}
