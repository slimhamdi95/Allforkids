<?php

namespace AllForKids\EntityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AllForKidsEntityBundle:Default:layout.html.twig');
    }
}
