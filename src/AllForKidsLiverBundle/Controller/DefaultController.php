<?php

namespace AllForKidsLiverBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AllForKidsLiverBundle:Default:index.html.twig');
    }
}
