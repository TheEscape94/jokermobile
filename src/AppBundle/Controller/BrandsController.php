<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Brands;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\FileUploader;

/**
 * Brand controller.
 *
 */
class BrandsController extends Controller
{
    /**
     * Lists all brand entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $brands = $em->getRepository('AppBundle:Brands')->findAll();

        return $this->render('brands/index.html.twig', array(
            'brands' => $brands,
        ));
    }

    /**
     * Creates a new brand entity.
     *
     */
    public function newAction(Request $request)
    {
        $brand = new Brands();
        $form = $this->createForm('AppBundle\Form\BrandsType', $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fileUploader = new FileUploader('bundles/app/upload/brands/');

            $file = $brand->getLogo();
            $fileName = $fileUploader->upload($file);

            $brand->setLogo($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($brand);
            $em->flush();

            return $this->redirectToRoute('admin_brendovi_new');
        }

        return $this->render('brands/new.html.twig', array(
            'brand' => $brand,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a brand entity.
     *
     */
    public function showAction(Brands $brand)
    {
        $deleteForm = $this->createDeleteForm($brand);

        return $this->render('brands/show.html.twig', array(
            'brand' => $brand,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing brand entity.
     *
     */
    public function editAction(Request $request, Brands $brand)
    {
        $deleteForm = $this->createDeleteForm($brand);
        $editForm = $this->createForm('AppBundle\Form\BrandsType', $brand);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_brendovi_new');
        }

        return $this->render('brands/edit.html.twig', array(
            'brand' => $brand,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a brand entity.
     *
     */
    public function deleteAction(Request $request, Brands $brand)
    {
        $form = $this->createDeleteForm($brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($brand);
            $em->flush();
        }

        return $this->redirectToRoute('admin_brendovi_new');
    }

    /**
     * Creates a form to delete a brand entity.
     *
     * @param Brands $brand The brand entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Brands $brand)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_brendovi_delete', array('id' => $brand->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
