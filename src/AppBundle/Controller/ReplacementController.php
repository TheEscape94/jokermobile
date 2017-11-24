<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Replacement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\FileUploader;

/**
 * Replacement controller.
 *
 */
class ReplacementController extends Controller
{
    /**
     * Lists all replacement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $replacements = $em->getRepository('AppBundle:Replacement')->findBy(array(), array(
            'id' => 'DESC',
        ));
        return $this->render('replacement/index.html.twig', array(
            'replacements' => $replacements,
        ));
    }

    /**
     * Creates a new replacement entity.
     *
     */

    public function newAction(Request $request, $id)
    {
        if($id){
            $em = $this->getDoctrine()->getManager();
            $chosed = $em->getRepository('AppBundle:Phones')->findOneBy(array(
                'id' => $id
            ));

            if($chosed){
                $phone = $chosed->getMark() . " " . $chosed->getModel();
            } else {
                $phone = "Model nije dostupan!";
            }
        }

        $replacement = new Replacement();
        $form = $this->createForm('AppBundle\Form\ReplacementType', $replacement);
        $form->handleRequest($request);

        $request->getSession()->getFlashBag()->clear();

        if ($form->isSubmitted() && $form->isValid()) {

            $fileUploader = new FileUploader('bundles/app/upload/replacement/');

            $files = $replacement->getImages();
            $images = array();

            if($files != null) {
                $key = 0;

                foreach ($files as $file)
                {
                    $fileName = $fileUploader->upload($file);
                    $images[$key++] = $fileName;
                }
                $images = implode('|', $images);
                $replacement->setImages($images);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($replacement);
            $em->flush();

            //sending notification email

            $message = \Swift_Message::newInstance()
                ->setSubject('Obavestenje sa JokerMobil.com')
                ->setFrom(['jokermobilapp@gmail.com' => 'JokerMobil.com'])
                ->setTo(['office@jokermobil.com'])
                ->setBody('Stigao je novi zahtev za zamenu! Pogledajte u admin panelu o čemu se radi.');
            $this->get('mailer')->send($message);

            $request->getSession()->getFlashBag()->add('success_replacement_buy', '');

            return $this->redirectToRoute('zamena_index', array('id' => $id));
        }

        return $this->render('replacement/new.html.twig', array(
            'replacement' => $replacement,
            'form' => $form->createView(),
            'chosed' => $phone,
            'test' => 'test string',
        ));
    }

    /**
     * Finds and displays a replacement entity.
     *
     */
    public function showAction(Replacement $replacement)
    {
        $deleteForm = $this->createDeleteForm($replacement);

        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppBundle:Replacement')->findOneBy(array(
            'id' => $replacement->getId(),
        ));
        $data->setIsRead(1);
        $em->flush();

        return $this->render('replacement/show.html.twig', array(
            'replacement' => $replacement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing replacement entity.
     *
     */
    public function editAction(Request $request, Replacement $replacement)
    {
        $deleteForm = $this->createDeleteForm($replacement);
        $editForm = $this->createForm('AppBundle\Form\ReplacementType', $replacement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('zamena_edit', array('id' => $replacement->getId()));
        }

        return $this->render('replacement/edit.html.twig', array(
            'replacement' => $replacement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a replacement entity.
     *
     */
    public function deleteAction(Request $request, Replacement $replacement)
    {
        $form = $this->createDeleteForm($replacement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($replacement);
            $em->flush();
        }

        return $this->redirectToRoute('zamena_index');
    }

    /**
     * Creates a form to delete a replacement entity.
     *
     * @param Replacement $replacement The replacement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Replacement $replacement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zamena_delete', array('id' => $replacement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
