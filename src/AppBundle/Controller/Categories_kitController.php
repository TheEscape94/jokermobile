<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Categories_kit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Categories_kit controller.
 *
 */
class Categories_kitController extends Controller
{
    /**
     * Lists all categories_kit entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories_kits = $em->getRepository('AppBundle:Categories_kit')->findBy(array(), array(
            'id' => 'DESC',
        ));

        return $this->render('categories_kit/index.html.twig', array(
            'categories_kits' => $categories_kits,
        ));
    }

    /**
     * Creates a new categories_kit entity.
     *
     */
    public function newAction(Request $request)
    {
        $categories_kit = new Categories_kit();
        $form = $this->createForm('AppBundle\Form\Categories_kitType', $categories_kit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categories_kit);
            $em->flush();

            return $this->redirectToRoute('admin_categories_kit_new');
        }

        return $this->render('categories_kit/new.html.twig', array(
            'categories_kit' => $categories_kit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categories_kit entity.
     *
     */
    public function showAction(Categories_kit $categories_kit)
    {
        $deleteForm = $this->createDeleteForm($categories_kit);

        return $this->render('categories_kit/show.html.twig', array(
            'categories_kit' => $categories_kit,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categories_kit entity.
     *
     */
    public function editAction(Request $request, Categories_kit $categories_kit)
    {
        $deleteForm = $this->createDeleteForm($categories_kit);
        $editForm = $this->createForm('AppBundle\Form\Categories_kitType', $categories_kit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_categories_kit_new');
        }

        return $this->render('categories_kit/edit.html.twig', array(
            'categories_kit' => $categories_kit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categories_kit entity.
     *
     */
    public function deleteAction(Request $request, Categories_kit $categories_kit)
    {
        $form = $this->createDeleteForm($categories_kit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categories_kit);
            $em->flush();
        }

        return $this->redirectToRoute('admin_categories_kit_new');
    }

    /**
     * Creates a form to delete a categories_kit entity.
     *
     * @param Categories_kit $categories_kit The categories_kit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Categories_kit $categories_kit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_categories_kit_delete', array('id' => $categories_kit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
