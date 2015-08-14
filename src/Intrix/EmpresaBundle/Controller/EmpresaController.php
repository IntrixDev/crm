<?php

namespace Intrix\EmpresaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Intrix\EmpresaBundle\Entity\Empresa;
use Intrix\EmpresaBundle\Form\EmpresaType;

/**
 * Empresa controller.
 *
 */
class EmpresaController extends Controller
{

    /**
    * Lista todos os registros do(a) Empresa.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EmpresaBundle:Empresa')->findAll();

        return $this->render('EmpresaBundle:Empresa:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Mostra o formulário para criar um(a) novo(a) Empresa.
     *
     */
    public function newAction()
    {
        $entity = new Empresa();
        $form   = $this->createCreateForm($entity);

        return $this->render('EmpresaBundle:Empresa:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Cria um novo(a) Empresa.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Empresa();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()->getFlashBag()->add(
                'notice', array(
                    'message' => 'Empresa salva com sucesso!',
                    'type' => 'success'
                )
            );

            return $this->redirect($this->generateUrl('empresa'));

        } else {
            $request->getSession()->getFlashBag()->add(
                'notice', array(
                    'message' => 'Ops, tivemos alguns problema, reveja o formulário!',
                    'type' => 'danger'
                )
            );
        }


        return $this->render('EmpresaBundle:Empresa:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Cria o formulário para Empresa
     *
     * @param Empresa $entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Empresa $entity)
    {
        $form = $this->createForm(new EmpresaType(), $entity, array(
            'action' => $this->generateUrl('empresa_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Criar'));

        return $form;
    }

    /**
     * Exibe um formulário para editar o(a)Empresa.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmpresaBundle:Empresa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possivel encontrar esse(a) Empresa.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('EmpresaBundle:Empresa:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Cria um formulário para editar o(a) Empresa.
    *
    * @param Empresa $entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Empresa $entity)
    {
        $form = $this->createForm(new EmpresaType(), $entity, array(
            'action' => $this->generateUrl('empresa_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Editar'));

        return $form;
    }
    /**
     * Edita um(a) Empresa
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmpresaBundle:Empresa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possivel encontrar esse(a) Empresa.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $request->getSession()->getFlashBag()->add(
                'notice', array(
                    'message' => 'Empresa editada com sucesso!',
                    'type' => 'success'
                )
            );

            return $this->redirect($this->generateUrl('empresa_edit', array('id' => $id)));
        } else {
            $request->getSession()->getFlashBag()->add(
                'notice', array(
                    'message' => 'Ops, tivemos alguns problema, reveja o formulário!',
                    'type' => 'danger'
                )
            );
        }

        return $this->render('EmpresaBundle:Empresa:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
}
