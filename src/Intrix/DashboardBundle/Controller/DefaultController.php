<?php

namespace Intrix\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('DashboardBundle:Default:index.html.twig');
    }

}
