<?php
/**
 * Created by PhpStorm.
 * User: Toka
 * Date: 11/15/17
 * Time: 11:01
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Discount;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DiscountController extends Controller
{
    /**
     * @Route("/discount/add_new", name="add_new_discount")
     *
     * @Method({"GET", "POST"})
     */

    public function addDiscountAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $type = $request->request->get('type');
            $quantity = $request->request->get('disc');
            $name = $request->request->get('name');
            $code = $request->request->get('code');

            $discount = new Discount();

            $discount->setType($type);
            $discount->setName($name);
            $discount->setQuantity($quantity);
            $discount->setDiscountPass($code);

            $em = $this->getDoctrine()->getManager();
            $em->persist($discount);
            $em->flush();

            return new JsonResponse(array(
                'id' => $discount->getId(),
                'name' => $discount->getName(),
                'month' => date_format($discount->getCreatedAt(), 'M'),
                'day' => date_format($discount->getCreatedAt(), 'd'),
                'code' => $discount->getDiscountPass(),
                'type' => $discount->getType(),
                'discount' => $discount->getQuantity(),
            ));
        }

        return new Response('This is not ajax!', 400);
    }

    /**
     * @Route("/discount/del_disc", name="del_disc")
     *
     * @Method({"GET", "POST"})
     */

    public function delDiscountAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {

            $id = $request->request->get('id');
            $em = $this->getDoctrine()->getManager();
            $discount = $em->getRepository('AppBundle:Discount')->findOneBy(array(
                'id' => $id,
            ));
            if($discount != null){
                $em->remove($discount);
                $em->flush();
            }
            return new JsonResponse(array());
        }

        return new Response('This is not ajax!', 400);
    }

    /**
     * @Route("/discount/find_discount", name="find_discount")
     *
     * @Method({"GET", "POST"})
     */

    public function findDiscountAction(Request $request, SessionInterface $session)
    {
        if ($request->isXMLHttpRequest()) {

            $code = $request->request->get('code');
            $em = $this->getDoctrine()->getManager();

            $discount = $em->getRepository('AppBundle:Discount')->findOneBy(array(
                'discountPass' => $code,
            ));

            if($discount != null){
                $session->set('discountQ', $discount->getQuantity());
                $session->set('discountN', $discount->getName());
                return new JsonResponse(array(
                    'finded' => true,
                    'name' => $discount->getName(),
                    'discount' => $discount->getQuantity(),
                    'type' => $discount->getType(),
                ));
            } else {
                $session->set('discount', '0');
                return new JsonResponse(array(
                    'finded' => false,
                ));
            }
        }

        return new Response('This is not ajax!', 400);
    }
}