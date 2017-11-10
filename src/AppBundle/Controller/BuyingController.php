<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Buying;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\FileUploader;

/**
 * Buying controller.
 *
 */
class BuyingController extends Controller
{
    /**
     * Lists all buying entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $buyings = $em->getRepository('AppBundle:Buying')->findBy(array(), array(
            'id' => "DESC"
        ));

        return $this->render('buying/index.html.twig', array(
            'buyings' => $buyings,
        ));
    }

    /**
     * Creates a new buying entity.
     *
     */
    public function newAction(Request $request)
    {
        $buying = new Buying();
        $form = $this->createForm('AppBundle\Form\BuyingType', $buying);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $fileUploader = new FileUploader('bundles/app/upload/replacement/');

            $files = $buying->getImages();
            $images = array();

            if($files != null) {
                $key = 0;

                foreach ($files as $file)
                {
                    $fileName = $fileUploader->upload($file);
                    $images[$key++] = $fileName;
                }
                $images = implode('|', $images);
                $buying->setImages($images);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($buying);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success_offer_buy', '');

            return $this->redirectToRoute('otkup_index');
        }

        return $this->render('buying/new.html.twig', array(
            'buying' => $buying,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a buying entity.
     *
     */
    public function showAction(Buying $buying)
    {
        $deleteForm = $this->createDeleteForm($buying);
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppBundle:Buying')->findOneBy(array(
            'id' => $buying->getId(),
        ));
        $data->setIsRead(1);
        $em->flush();

        return $this->render('buying/show.html.twig', array(
            'buying' => $buying,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing buying entity.
     *
     */
    public function editAction(Request $request, Buying $buying)
    {
        $deleteForm = $this->createDeleteForm($buying);
        $editForm = $this->createForm('AppBundle\Form\BuyingType', $buying);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('otkup_edit', array('id' => $buying->getId()));
        }

        return $this->render('buying/edit.html.twig', array(
            'buying' => $buying,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a buying entity.
     *
     */
    public function deleteAction(Request $request, Buying $buying)
    {
        $form = $this->createDeleteForm($buying);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($buying);
            $em->flush();
        }

        return $this->redirectToRoute('otkup_index');
    }

    /**
     * Creates a form to delete a buying entity.
     *
     * @param Buying $buying The buying entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Buying $buying)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('otkup_delete', array('id' => $buying->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
