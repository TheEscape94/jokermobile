<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Phones;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\FileUploader;

/**
 * Phone controller.
 *
 */
class PhonesController extends Controller
{
    /**
     * Lists all phone entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $phones = $em->getRepository('AppBundle:Phones')->findBy(array(), array(
            'id' => 'DESC',
        ));

        return $this->render('phones/index.html.twig', array(
            'phones' => $phones,
        ));
    }

    public function viewAction()
    {
        $em = $this->getDoctrine()->getManager();

        $phones = $em->getRepository('AppBundle:Phones')->findAll();

        return $this->render('phones/view.html.twig', array(
            'phones' => $phones,
        ));
    }

    /**
     * Creates a new phone entity.
     *
     */
    public function newAction(Request $request)
    {
        $phone = new Phones();

        $em = $this->getDoctrine()->getManager();
        $allTags = $em->getRepository('AppBundle:Tags')->findAll();

        $allCat = $em->getRepository('AppBundle:Categories_phones')->findBy(array(), array(
            'name' => 'ASC',
        ));

        $form = $this->createForm('AppBundle\Form\PhonesType', $phone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $fileUploader = new FileUploader('bundles/app/upload/phones/');

            $files = $phone->getImages();
            $images = array();

            if($files != null) {
                $key = 0;

                foreach ($files as $file)
                {
                    $fileName = $fileUploader->upload($file);
                    $images[$key++] = $fileName;
                }
                $images = implode('|', $images);
                $phone->setImages($images);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($phone);
            $em->flush();

            return $this->redirectToRoute('admin_telefoni_show', array('id' => $phone->getId()));
        }

        return $this->render('phones/new.html.twig', array(
            'phone' => $phone,
            'form' => $form->createView(),
            'tags' => $allTags,
            'cat' => $allCat,
        ));
    }

    /**
     * Finds and displays a phone entity.
     *
     */
    public function showAction(Phones $phone)
    {
        $deleteForm = $this->createDeleteForm($phone);

        return $this->render('phones/show.html.twig', array(
            'phone' => $phone,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing phone entity.
     *
     */
    public function editAction(Request $request, Phones $phone)
    {
        $em = $this->getDoctrine()->getManager();
        $allTags = $em->getRepository('AppBundle:Tags')->findAll();

        $deleteForm = $this->createDeleteForm($phone);
        $editForm = $this->createForm('AppBundle\Form\PhonesType', $phone);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $fileUploader = new FileUploader('bundles/app/upload/phones/');

            $files = $phone->getImages();
            $images = array();

            if($files != null) {
                $key = 0;

                foreach ($files as $file)
                {
                    $fileName = $fileUploader->upload($file);
                    $images[$key++] = $fileName;
                }
                $images = implode('|', $images);
                $phone->setImages($images);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_telefoni_show', array('id' => $phone->getId()));
        }

        return $this->render('phones/edit.html.twig', array(
            'phone' => $phone,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'tags' => $allTags
        ));
    }

    /**
     * Deletes a phone entity.
     *
     */
    public function deleteAction(Request $request, Phones $phone)
    {
        $form = $this->createDeleteForm($phone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($phone);
            $em->flush();
        }

        return $this->redirectToRoute('admin_telefoni_index');
    }

    /**
     * Creates a form to delete a phone entity.
     *
     * @param Phones $phone The phone entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Phones $phone)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_telefoni_delete', array('id' => $phone->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
