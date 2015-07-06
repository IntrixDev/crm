<?php

namespace Intrix\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Intrix\BackendBundle\Entity\Empresa;
use Intrix\BackendBundle\Form\EmpresaType;

/**
 * Empresa controller.
 *
 */
class EmpresaController extends Controller {

    /**
     * Lists all Empresa entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BackendBundle:Empresa')->findAll();

        return $this->render('BackendBundle:Empresa:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Empresa entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Empresa();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('empresa_show', array('id' => $entity->getId())));
        } else {
            $request->getSession()->getFlashBag()->add(
                    'notice', array(
                'message' => 'Ops, tivemos alguns problema, reveja o formulário!',
                'type' => 'error'
                    )
            );
        }

        return $this->render('BackendBundle:Empresa:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Empresa entity.
     *
     * @param Empresa $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Empresa $entity) {
        $form = $this->createForm(new EmpresaType(), $entity, array(
            'action' => $this->generateUrl('empresa_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Empresa entity.
     *
     */
    public function newAction() {
        $entity = new Empresa();
        $form = $this->createCreateForm($entity);

        return $this->render('BackendBundle:Empresa:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Empresa entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Empresa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empresa entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BackendBundle:Empresa:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Empresa entity.
     *
     * @param Empresa $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Empresa $entity) {
        $form = $this->createForm(new EmpresaType(), $entity, array(
            'action' => $this->generateUrl('empresa_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Empresa entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Empresa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empresa entity.');
        }


        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('empresa_edit', array('id' => $id)));
        } else {
            $request->getSession()->getFlashBag()->add(
                    'notice', array(
                'message' => 'Reveja o formulário, erros foram encontrados.',
                'type' => 'danger'
                    )
            );
        }

        return $this->render('BackendBundle:Empresa:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

}
