<?php

namespace Intrix\ContatoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ContatoBundle:Default:index.html.twig', array('name' => $name));
    }
}
