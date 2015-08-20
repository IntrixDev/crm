<?php

namespace Intrix\EmpresaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Intrix\EmpresaBundle\Entity\Seguimento;
use Intrix\EmpresaBundle\Form\SeguimentoType;

/**
 * Seguimento controller.
 *
 */
class SeguimentoController extends Controller
{

    /**
    * Lista todos os registros do(a) Seguimento.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EmpresaBundle:Seguimento')->findAll();

        return $this->render('EmpresaBundle:Seguimento:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Mostra o formulário para criar um(a) novo(a) Seguimento.
     *
     */
    public function newAction()
    {
        $entity = new Seguimento();
        $form   = $this->createCreateForm($entity);

        return $this->render('EmpresaBundle:Seguimento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Cria um novo(a) Seguimento.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Seguimento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()->getFlashBag()->add(
                'notice', array(
                    'message' => 'Seguimento salvo com sucesso!',
                    'type' => 'success'
                )
            );

            return $this->redirect($this->generateUrl('seguimento'));

        } else {
            $request->getSession()->getFlashBag()->add(
                'notice', array(
                    'message' => 'Ops, tivemos alguns problema, reveja o formulário!',
                    'type' => 'danger'
                )
            );
        }


        return $this->render('EmpresaBundle:Seguimento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Cria o formulário para Seguimento
     *
     * @param Seguimento $entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Seguimento $entity)
    {
        $form = $this->createForm(new SeguimentoType(), $entity, array(
            'action' => $this->generateUrl('seguimento_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Criar'));

        return $form;
    }

    /**
     * Exibe um formulário para editar o(a)Seguimento.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmpresaBundle:Seguimento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possivel encontrar esse Seguimento.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('EmpresaBundle:Seguimento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Cria um formulário para editar o(a) Seguimento.
    *
    * @param Seguimento $entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Seguimento $entity)
    {
        $form = $this->createForm(new SeguimentoType(), $entity, array(
            'action' => $this->generateUrl('seguimento_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Editar'));

        return $form;
    }
    /**
     * Edita um(a) Seguimento
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmpresaBundle:Seguimento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possivel encontrar esse Seguimento.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $request->getSession()->getFlashBag()->add(
                'notice', array(
                    'message' => 'Seguimento editado com sucesso!',
                    'type' => 'success'
                )
            );

            return $this->redirect($this->generateUrl('seguimento_edit', array('id' => $id)));
        } else {
            $request->getSession()->getFlashBag()->add(
                'notice', array(
                    'message' => 'Ops, tivemos alguns problema, reveja o formulário!',
                    'type' => 'danger'
                )
            );
        }

        return $this->render('EmpresaBundle:Seguimento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
}
