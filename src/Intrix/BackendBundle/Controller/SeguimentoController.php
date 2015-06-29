<?php

namespace Intrix\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Intrix\BackendBundle\Entity\Seguimento;
use Intrix\BackendBundle\Form\SeguimentoType;

/**
 * Seguimento controller.
 *
 */
class SeguimentoController extends Controller {

    /**
     * Lists all Seguimento entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BackendBundle:Seguimento')->findAll();

        return $this->render('BackendBundle:Seguimento:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Displays a form to create a new Seguimento entity.
     *
     */
    public function newAction() {
        $entity = new Seguimento();
        $form = $this->createCreateForm($entity);

        return $this->render('BackendBundle:Seguimento:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Seguimento entity.
     *
     * @param Seguimento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Seguimento $entity) {
        $form = $this->createForm(new SeguimentoType(), $entity, array(
            'action' => $this->generateUrl('seguimento_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Creates a new Seguimento entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Seguimento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()->getFlashBag()->add(
                    'notice', 'Seguimento salvo com sucesso!'
            );
            return $this->redirect($this->generateUrl('seguimento_new'));
        }

        return $this->render('BackendBundle:Seguimento:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Seguimento entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Seguimento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possivel encontrar esse seguimento.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BackendBundle:Seguimento:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Seguimento entity.
     *
     * @param Seguimento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Seguimento $entity) {
        $form = $this->createForm(new SeguimentoType(), $entity, array(
            'action' => $this->generateUrl('seguimento_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Seguimento entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Seguimento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possivel encontrar esse seguimento.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $request->getSession()->getFlashBag()->add(
                    'notice', 'Seguimento salvo com sucesso!'
            );

            return $this->redirect($this->generateUrl('seguimento_edit', array('id' => $id)));
        }

        return $this->render('BackendBundle:Seguimento:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

}
