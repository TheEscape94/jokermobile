<?php
/**
 * Created by PhpStorm.
 * User: Toka
 * Date: 11/15/17
 * Time: 3:06
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Session\SessionInterface;


class FavoriteController extends Controller
{
    /**
     * @Route("/wishlist/add_to_wishlist", name="add_to_wishlist_items")
     *
     * @Method({"GET", "POST"})
     */

    public function addToWishListAction(Request $request, SessionInterface $session)
    {
        if ($request->isXMLHttpRequest()) {
            $id = $request->request->get('id');
            $type = $request->request->get('type');
            $link = $request->request->get('link');

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
                $articles = $session->get('wishlist');

                if($articles == null){
                    $articles = [];
                }

                array_push($articles, [
                    'id' => $id,
                    'name' => $objectName,
                    'price' => $objectPrice,
                    'img' => $images[0],
                    'link' => $link,
                    'type' => $type,
                ]);

                $session->set('wishlist', $articles);

                return new JsonResponse(array(
                    'id' => $id,
                    'name' => $objectName,
                    'price' => $objectPrice,
                    'img' => $images[0],
                    'link' => $link,
                    'type' => $type,
                ));
            }
        }
    }

    /**
     * @Route("/wishlist/del_from_wishlist", name="del_from_wishlist_items")
     *
     * @Method({"GET", "POST"})
     */

    public function delFromCartAction(Request $request, SessionInterface $session)
    {
        if ($request->isXMLHttpRequest()) {

            $session->remove('wishlist');

            return new JsonResponse(array());
        }

        return new Response('This is not ajax!', 400);
    }
}