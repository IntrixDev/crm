<?php

namespace Intrix\ContatoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Intrix\ContatoBundle\Entity\Contato;
use Intrix\ContatoBundle\Form\ContatoType;

/**
 * Contato controller.
 *
 */
class ContatoController extends Controller
{

    /**
    * Lista todos os registros do(a) Contato.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ContatoBundle:Contato')->findAll();

        return $this->render('ContatoBundle:Contato:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Mostra o formulário para criar um(a) novo(a) Contato.
     *
     */
    public function newAction()
    {
        $entity = new Contato();
        $form   = $this->createCreateForm($entity);

        return $this->render('ContatoBundle:Contato:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Cria um novo(a) Contato.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Contato();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()->getFlashBag()->add(
                'notice', array(
                    'message' => 'Contato salva com sucesso!',
                    'type' => 'success'
                )
            );

            return $this->redirect($this->generateUrl('contato'));

        } else {
            $request->getSession()->getFlashBag()->add(
                'notice', array(
                    'message' => 'Ops, tivemos alguns problema, reveja o formulário!',
                    'type' => 'danger'
                )
            );
        }


        return $this->render('ContatoBundle:Contato:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Cria o formulário para Contato
     *
     * @param Contato $entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Contato $entity)
    {
        $form = $this->createForm(new ContatoType(), $entity, array(
            'action' => $this->generateUrl('contato_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Criar'));

        return $form;
    }

    /**
     * Exibe um formulário para editar o(a)Contato.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ContatoBundle:Contato')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possivel encontrar esse(a) Contato.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('ContatoBundle:Contato:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Cria um formulário para editar o(a) Contato.
    *
    * @param Contato $entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Contato $entity)
    {
        $form = $this->createForm(new ContatoType(), $entity, array(
            'action' => $this->generateUrl('contato_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Editar'));

        return $form;
    }
    /**
     * Edita um(a) Contato
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ContatoBundle:Contato')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possivel encontrar esse(a) Contato.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $request->getSession()->getFlashBag()->add(
                'notice', array(
                    'message' => 'Contato editada com sucesso!',
                    'type' => 'success'
                )
            );

            return $this->redirect($this->generateUrl('contato_edit', array('id' => $id)));
        } else {
            $request->getSession()->getFlashBag()->add(
                'notice', array(
                    'message' => 'Ops, tivemos alguns problema, reveja o formulário!',
                    'type' => 'danger'
                )
            );
        }

        return $this->render('ContatoBundle:Contato:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
}
