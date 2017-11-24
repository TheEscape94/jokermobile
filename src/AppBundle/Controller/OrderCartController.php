<?php

namespace AppBundle\Controller;

use AppBundle\Entity\OrderCart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Ordercart controller.
 *
 */
class OrderCartController extends Controller
{
    /**
     * Lists all orderCart entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $orderCarts = $em->getRepository('AppBundle:OrderCart')->findAll();

        return $this->render('ordercart/index.html.twig', array(
            'orderCarts' => $orderCarts,
        ));
    }

    /**
     * Creates a new orderCart entity.
     *
     */
    public function newAction(Request $request)
    {
        $orderCart = new Ordercart();
        $form = $this->createForm('AppBundle\Form\OrderCartType', $orderCart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($orderCart);
            $em->flush();

            return $this->redirectToRoute('korpa_show', array('id' => $orderCart->getId()));
        }

        return $this->render('ordercart/new.html.twig', array(
            'orderCart' => $orderCart,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a orderCart entity.
     *
     */
    public function showAction(OrderCart $orderCart)
    {
        $deleteForm = $this->createDeleteForm($orderCart);

        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppBundle:OrderCart')->findOneBy(array(
            'id' => $orderCart->getId(),
        ));
        $data->setIsRead(1);
        $em->flush();

        return $this->render('ordercart/show.html.twig', array(
            'orderCart' => $orderCart,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing orderCart entity.
     *
     */
    public function editAction(Request $request, OrderCart $orderCart)
    {
        $deleteForm = $this->createDeleteForm($orderCart);
        $editForm = $this->createForm('AppBundle\Form\OrderCartType', $orderCart);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('korpa_edit', array('id' => $orderCart->getId()));
        }

        return $this->render('ordercart/edit.html.twig', array(
            'orderCart' => $orderCart,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a orderCart entity.
     *
     */
    public function deleteAction(Request $request, OrderCart $orderCart)
    {
        $form = $this->createDeleteForm($orderCart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($orderCart);
            $em->flush();
        }

        return $this->redirectToRoute('korpa_index');
    }

    /**
     * Creates a form to delete a orderCart entity.
     *
     * @param OrderCart $orderCart The orderCart entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(OrderCart $orderCart)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('korpa_delete', array('id' => $orderCart->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @Route("/cart/set_delivery_true", name="set_delivery_true")
     */

    public function setDeliveryAction(Request $request){
        if ($request->isXMLHttpRequest()) {
            $id = $request->request->get('id');
            $em = $this->getDoctrine()->getManager();
            $data = $em->getRepository('AppBundle:OrderCart')->findOneBy(array(
                'id' => $id,
            ));
            if($data != null) {
                $data->setDelivered(1);
                $em->flush();
                $c = true;
            } else {
                $c = false;
            }
            return new JsonResponse(array(
                'res' => $c,
            ));
        }
        return new Response('This is not ajax!', 400);
    }
}
