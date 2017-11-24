<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Inbox;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Inbox controller.
 *
 */
class InboxController extends Controller
{
    /**
     * Lists all inbox entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $inboxes = $em->getRepository('AppBundle:Inbox')->findAll();
        $new = count($em->getRepository('AppBundle:Inbox')->findBy(array(
            'isRead' => 0,
        )));

        return $this->render('inbox/index.html.twig', array(
            'inboxes' => $inboxes,
            'new' => $new,
        ));
    }

    /**
     * Creates a new inbox entity.
     *
     */
    public function newAction(Request $request)
    {
        $inbox = new Inbox();
        $form = $this->createForm('AppBundle\Form\InboxType', $inbox);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($inbox);
            $em->flush();

            //sending notification email

            $message = \Swift_Message::newInstance()
                ->setSubject('Obavestenje sa JokerMobil.com')
                ->setFrom(['jokermobilapp@gmail.com' => 'JokerMobil.com'])
                ->setTo(['office@jokermobil.com'])
                ->setBody('Stigao je novi zahtev za kontakt! Pogledajte u admin panelu o čemu se radi.');
            $this->get('mailer')->send($message);

            $msg = "Poruka uspešno poslata! Uskoro ćemo Vas kontaktirati";

            return $this->render('inbox/new.html.twig', array(
                'contact_success' => $msg,
            ));
        }

        return $this->render('inbox/new.html.twig', array(
            'inbox' => $inbox,
            'form' => $form->createView(),
            'contact_success' => null,
        ));
    }

    /**
     * Finds and displays a inbox entity.
     *
     */
    public function showAction(Inbox $inbox)
    {
        $deleteForm = $this->createDeleteForm($inbox);

        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppBundle:Inbox')->findOneBy(array(
            'id' => $inbox->getId(),
        ));
        $data->setIsRead(1);
        $em->flush();

        return $this->render('inbox/show.html.twig', array(
            'inbox' => $inbox,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing inbox entity.
     *
     */
    public function editAction(Request $request, Inbox $inbox)
    {
        $deleteForm = $this->createDeleteForm($inbox);
        $editForm = $this->createForm('AppBundle\Form\InboxType', $inbox);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_inbox_edit', array('id' => $inbox->getId()));
        }

        return $this->render('inbox/edit.html.twig', array(
            'inbox' => $inbox,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a inbox entity.
     *
     */
    public function deleteAction(Request $request, Inbox $inbox)
    {
        $form = $this->createDeleteForm($inbox);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($inbox);
            $em->flush();
        }

        return $this->redirectToRoute('admin_inbox_index');
    }

    /**
     * Creates a form to delete a inbox entity.
     *
     * @param Inbox $inbox The inbox entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Inbox $inbox)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_inbox_delete', array('id' => $inbox->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
