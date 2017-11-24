<?php
/**
 * Created by PhpStorm.
 * User: Toka
 * Date: 11/14/17
 * Time: 17:30
 */

namespace AppBundle\Controller;

use AppBundle\Entity\EmailList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\OrderCart;

use Symfony\Component\HttpFoundation\Session\SessionInterface;


class CartController extends Controller
{

    //cart preview

    /**
     * @Route("/mojakorpa", name="cart")
     */

    public function indexAction(Request $request, SessionInterface $session)
    {
        if($session->get('articles') != null){
            $art = $session->get('articles');
        } else {
            $art = array();
        }
        $orderNum = rand(99999, 9999999);

        $orderCart = new Ordercart();
        $form = $this->createForm('AppBundle\Form\OrderCartType', $orderCart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $orderTxt = "";
            $orderPrice = 0;

            foreach($art as $i){
                $orderTxt .= $i['name'] . "-" . $i['q'] . "-" . $i['price'] . "-" . $i['q'] * $i['price'] . " | ";
                $orderPrice = $orderPrice + $i['q'] * $i['price'];
            }

            $orderCart->setOrderNum($orderNum);
            ($session->get('discountQ') != '') ? $orderCart->setDiscount($session->get('discountQ')) : $orderCart->setDiscount('0');
            ($session->get('discountN') != '') ? $orderCart->setDiscountName($session->get('discountN')) : $orderCart->setDiscountName('/');
            $orderCart->setOrderTxt($orderTxt);
            $orderCart->setOrderPrice($orderPrice);

            $em = $this->getDoctrine()->getManager();
            $em->persist($orderCart);
            $em->flush();

            //unset article, discountQ, discountN
            $session->remove('articles');
            $session->remove('discountQ');
            $session->remove('discountN');

            //put email from order to mailing list

            $emailList = new EmailList();
            $emailList->setEmail($orderCart->getEmail());
            $em->persist($emailList);
            $em->flush();

            //sending notification email

            $message = \Swift_Message::newInstance()
                ->setSubject('Obavestenje sa JokerMobil.com')
                ->setFrom(['jokermobilapp@gmail.com' => 'JokerMobil.com'])
                ->setTo(['office@jokermobil.com'])
                ->setBody('Stigla je nova porudžbina! Pogledajte u admin panelu o čemu se radi.');
            $this->get('mailer')->send($message);

            return $this->render('engine/cartpreview.html.twig', array(
                'msg' => 'Vaša porudžbina je uspešno poslata!',
            ));
        }

        return $this->render('engine/cartpreview.html.twig', array(
            'articles' => $art,
            'orderNum' => $orderNum,
            'orderCart' => $orderCart,
            'form' => $form->createView(),
            'msg' => null,
        ));
    }


    /**
     * @Route("/cart/add_to_cart", name="add_to_cart_items")
     *
     * @Method({"GET", "POST"})
     */

    public function addToCartAction(Request $request, SessionInterface $session)
    {

        if ($request->isXMLHttpRequest()) {

            $id = $request->request->get('id');
            $q = $request->request->get('q');

            //0 - phones | 1 - equiment
            $type = $request->request->get('type');

            $em = $this->getDoctrine()->getManager();
            if($type == 0){
                $object = $em->getRepository("AppBundle:Phones")->findOneBy(array(
                    'id' => $id
                ));
                $objectName = $object->getMark() . ' ' . $object->getModel();
            } else {
                $object = $em->getRepository("AppBundle:Equiment")->findOneBy(array(
                    'id' => $id
                ));
                $objectName = $object->getMark() . ' ' . $object->getName();
            }

            if(!empty($object)){
                $objectPrice = $object->getPriceOff();
                if($objectPrice > 0){
                    $objectPrice =$object->getPrice() - ($objectPrice / 100 * $object->getPrice());
                } else {
                    $objectPrice = $object->getPrice();
                }
                $images = explode('|', $object->getImages());
                $articles = $session->get('articles');

                if($articles == null){
                    $articles = [];
                }

                array_push($articles, [
                   'id' => $id,
                   'name' => $objectName,
                   'price' => $objectPrice,
                   'img' => $images[0],
                   'q' => $q,
                   'qq' => count($articles) - 1,
                   'type' => $type,
                ]);

                $session->set('articles', $articles);

                return new JsonResponse(array(
                    'id' => $id,
                    'name' => $objectName,
                    'price' => $objectPrice,
                    'img' => $images[0],
                    'q' => $q,
                    'qq' => count($articles) - 1,
                    'type' => $type,
                ));
            }
        }

        return new Response('This is not ajax!', 400);
    }

    /**
     * @Route("/cart/del_one_from_cart", name="del_one_from_cart_items")
     *
     * @Method({"GET", "POST"})
     */

    public function delOneFromCartAction(Request $request, SessionInterface $session)
    {
        if ($request->isXMLHttpRequest()) {

            $id = $request->request->get('id');
            $articles = $session->get('articles');

            $price = $articles[$id]['price'];
            $q = $articles[$id]['q'];

            $session->remove('articles');

            array_splice($articles, $id, 1);

            $session->set('articles', $articles);

            return new JsonResponse(array(
                'price' => $price,
                'q' => $q,
            ));
        }

        return new Response('This is not ajax!', 400);
    }


    /**
     * @Route("/cart/del_from_cart", name="del_from_cart_items")
     *
     * @Method({"GET", "POST"})
     */

    public function delFromCartAction(Request $request, SessionInterface $session)
    {
        if ($request->isXMLHttpRequest()) {

            $session->remove('articles');

            return new JsonResponse(array());
        }

        return new Response('This is not ajax!', 400);
    }
}