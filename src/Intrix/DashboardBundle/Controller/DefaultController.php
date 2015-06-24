<?php

namespace Intrix\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        $aWidgets = array();

        foreach ($this->getUser()->getDashboards() as $oDashboard) {
            array_push($aWidgets, $this->get('cocur_slugify')->slugify($oDashboard->getNome()));
        }
        
        return $this->render('DashboardBundle:Default:index.html.twig', array(
                    'aWidgets' => $aWidgets
        ));
    }

    public function dicasAction() {
        return $this->render('DashboardBundle:Default:_dicas.html.twig');
    }

    public function estatisticasAction() {
        return $this->render('DashboardBundle:Default:_estatisticas.html.twig');
    }

    public function comissoesAction() {
        return $this->render('DashboardBundle:Default:_comissoes.html.twig');
    }

    public function clientesAction() {
        return $this->render('DashboardBundle:Default:_clientes.html.twig');
    }

}
