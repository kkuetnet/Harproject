<?php

namespace Harproject\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Harproject\AppBundle\Entity\Member;
use Harproject\AppBundle\Form\MemberType;

/**
 * Member controller.
 *
 */
class MemberController extends Controller
{

    /**
     * Lists all Member entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('HarprojectAppBundle:Member')->findAll();

        return $this->render('HarprojectAppBundle:Member:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Member entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Member();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('harproject_app_member_show', array('id' => $entity->getId())));
        }

        return $this->render('HarprojectAppBundle:Member:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Member entity.
     *
     * @param Member $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Member $entity)
    {
        $form = $this->createForm(new MemberType(), $entity, array(
            'action' => $this->generateUrl('harproject_app_member_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Member entity.
     *
     */
    public function newAction()
    {
        $entity = new Member();
        $form   = $this->createCreateForm($entity);

        return $this->render('HarprojectAppBundle:Member:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Member entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HarprojectAppBundle:Member')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Member entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('HarprojectAppBundle:Member:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Member entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HarprojectAppBundle:Member')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Member entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('HarprojectAppBundle:Member:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Member entity.
    *
    * @param Member $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Member $entity)
    {
        $form = $this->createForm(new MemberType(), $entity, array(
            'action' => $this->generateUrl('harproject_app_member_update', array('id' => $entity->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Member entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HarprojectAppBundle:Member')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Member entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('harproject_app_member_edit', array('id' => $id)));
        }

        return $this->render('HarprojectAppBundle:Member:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Member entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HarprojectAppBundle:Member')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Member entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('harproject_app_member'));
    }

    /**
     * Creates a form to delete a Member entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('harproject_app_member_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
