<?php

namespace Intrix\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GerenciadorController extends Controller {

    public function indexAction() {
        $aDashboard = $this->getDoctrine()
                ->getRepository('DashboardBundle:Dashboard')
                ->findAll();

        $aAtivos = array();

        foreach ($this->getUser()->getDashboards() as $oDashboard) {
            array_push($aAtivos, $oDashboard->getId());
        }

        return $this->render('DashboardBundle:Gerenciador:index.html.twig', array(
                    'aDashboard' => $aDashboard,
                    'aAtivos' => $aAtivos
        ));
    }

    public function deleteAction($id) {

        $oDashboard = $this->getDoctrine()
                ->getRepository('DashboardBundle:Dashboard')
                ->find($id);

        $this->getUser()->removeDashboard($oDashboard);

        $em = $this->getDoctrine()->getManager();
        $em->persist($this->getUser());
        $em->flush();

        return $this->redirect($this->generateUrl('gerenciador_list'));
    }

    public function createAction($id) {

        $oDashboard = $this->getDoctrine()
                ->getRepository('DashboardBundle:Dashboard')
                ->find($id);

        $this->getUser()->addDashboard($oDashboard);

        $em = $this->getDoctrine()->getManager();
        $em->persist($this->getUser());
        $em->flush();

        return $this->redirect($this->generateUrl('gerenciador_list'));
    }

}
