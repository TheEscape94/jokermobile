<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Categories_phones;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Categories_phone controller.
 *
 */
class Categories_phonesController extends Controller
{
    /**
     * Lists all categories_phone entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories_phones = $em->getRepository('AppBundle:Categories_phones')->findBy(array(), array(
            'id' => 'DESC',
        ));

        return $this->render('categories_phones/index.html.twig', array(
            'categories_phones' => $categories_phones,
        ));
    }

    /**
     * Creates a new categories_phone entity.
     *
     */
    public function newAction(Request $request)
    {
        $categories_phone = new Categories_phones();
        $form = $this->createForm('AppBundle\Form\Categories_phonesType', $categories_phone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categories_phone);
            $em->flush();

            return $this->redirectToRoute('admin_kategorije_new');
        }

        return $this->render('categories_phones/new.html.twig', array(
            'categories_phone' => $categories_phone,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categories_phone entity.
     *
     */
    public function showAction(Categories_phones $categories_phone)
    {
        $deleteForm = $this->createDeleteForm($categories_phone);

        return $this->render('categories_phones/show.html.twig', array(
            'categories_phone' => $categories_phone,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categories_phone entity.
     *
     */
    public function editAction(Request $request, Categories_phones $categories_phone)
    {
        $deleteForm = $this->createDeleteForm($categories_phone);
        $editForm = $this->createForm('AppBundle\Form\Categories_phonesType', $categories_phone);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_kategorije_new');
        }

        return $this->render('categories_phones/edit.html.twig', array(
            'categories_phone' => $categories_phone,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categories_phone entity.
     *
     */
    public function deleteAction(Request $request, Categories_phones $categories_phone)
    {
        $form = $this->createDeleteForm($categories_phone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categories_phone);
            $em->flush();
        }

        return $this->redirectToRoute('admin_kategorije_new');
    }

    /**
     * Creates a form to delete a categories_phone entity.
     *
     * @param Categories_phones $categories_phone The categories_phone entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Categories_phones $categories_phone)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_kategorije_delete', array('id' => $categories_phone->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
