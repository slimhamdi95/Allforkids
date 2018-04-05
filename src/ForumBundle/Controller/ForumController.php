<?php

namespace ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ForumController extends Controller
{
    public function CreationAction()
    {
        return $this->render('ForumBundle:Forum:creation.html.twig', array(
            // ...
        ));
    }

}
