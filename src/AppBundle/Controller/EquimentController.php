<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Equiment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\FileUploader;

/**
 * Equiment controller.
 *
 */
class EquimentController extends Controller
{
    /**
     * Lists all equiment entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $equiments = $em->getRepository('AppBundle:Equiment')->findBy(array(), array(
            'id' => 'DESC'
        ));

        return $this->render('equiment/index.html.twig', array(
            'equiments' => $equiments,
        ));
    }

    public function viewAction()
    {
        $em = $this->getDoctrine()->getManager();

        $equiments = $em->getRepository('AppBundle:Equiment')->findAll();

        return $this->render('equiment/view.html.twig', array(
            'equiments' => $equiments,
        ));
    }

    /**
     * Creates a new equiment entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository('AppBundle:Categories_kit')->findBy(array(), array(
            'name' => 'ASC'
        ));

        $equiment = new Equiment();

        $em = $this->getDoctrine()->getManager();
        $allTags = $em->getRepository('AppBundle:Tags')->findAll();

        $form = $this->createForm('AppBundle\Form\EquimentType', $equiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $fileUploader = new FileUploader('bundles/app/upload/equiment/');

            $files = $equiment->getImages();
            $images = array();

            if($files != null) {
                $key = 0;

                foreach ($files as $file)
                {
                    $fileName = $fileUploader->upload($file);
                    $images[$key++] = $fileName;
                }
                $images = implode('|', $images);
                $equiment->setImages($images);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($equiment);
            $em->flush();

            return $this->redirectToRoute('admin_oprema_show', array('id' => $equiment->getId()));
        }

        return $this->render('equiment/new.html.twig', array(
            'equiment' => $equiment,
            'form' => $form->createView(),
            'tags' => $allTags,
            'cat' => $cat
        ));
    }

    /**
     * Finds and displays a equiment entity.
     *
     */
    public function showAction(Equiment $equiment)
    {

        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository('AppBundle:Categories_kit')->findBy(array(), array(
            'name' => 'ASC'
        ));

        $deleteForm = $this->createDeleteForm($equiment);

        return $this->render('equiment/show.html.twig', array(
            'equiment' => $equiment,
            'delete_form' => $deleteForm->createView(),
            'cat' => $cat
        ));
    }

    /**
     * Displays a form to edit an existing equiment entity.
     *
     */
    public function editAction(Request $request, Equiment $equiment)
    {
        $deleteForm = $this->createDeleteForm($equiment);
        $editForm = $this->createForm('AppBundle\Form\EquimentType', $equiment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_oprema_edit', array('id' => $equiment->getId()));
        }

        return $this->render('equiment/edit.html.twig', array(
            'equiment' => $equiment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a equiment entity.
     *
     */
    public function deleteAction(Request $request, Equiment $equiment)
    {
        $form = $this->createDeleteForm($equiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($equiment);
            $em->flush();
        }

        return $this->redirectToRoute('admin_oprema_index');
    }

    /**
     * Creates a form to delete a equiment entity.
     *
     * @param Equiment $equiment The equiment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Equiment $equiment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_oprema_delete', array('id' => $equiment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
