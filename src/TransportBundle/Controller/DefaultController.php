<?php

namespace TransportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Transport/Default/index.html.twig');
    }

    public function mapAction()
    {
        return $this->render('@Transport/Default/map.html.twig');
    }
}
