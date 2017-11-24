<?php
/**
 * Created by PhpStorm.
 * User: Toka
 * Date: 10/17/17
 * Time: 0:54
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PartsController extends Controller
{
    /**
     * @Route("/header_part_one", name="header_part_one")
     */
    public function headerAction(Request $request, SessionInterface $session)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('AppBundle:Categories_kit')->findBy(array(), array(
            'id' => 'DESC',
        ));

        $allprice = 0;
        $articles = $session->get('articles');
        if ($articles != null){
            for($i = 0; $i < count($articles); $i++){
                $allprice = $allprice + $articles[$i]['price'] * $articles[$i]['q'];
            }
        }


        return $this->render('parts/header.html.twig', array(
            'categories' => $categories,
            'allprice' => $allprice,
        ));
    }

    /**
     * @Route("/sidebar_part_one", name="sidebar_part_one")
     */
    public function sidebarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('AppBundle:Categories_phones')->findBy(array(), array(
            'id' => 'DESC',
        ));
        $tags = $em->getRepository('AppBundle:Tags')->findAll();
        $popular = $em->getRepository('AppBundle:Phones')->findBy(array(), array(
            'views' => 'DESC',
        ), 3);
        $top = $em->getRepository('AppBundle:Phones')->findBy(array(), array(
            'priceOff' => 'DESC',
        ), 5);

        // replace this example code with whatever you need
        return $this->render('parts/sidebar.html.twig', array(
            'categories' => $categories,
            'tags' => $tags,
            'popular' => $popular,
            'top' => $top,
        ));
    }

    /**
     * @Route("/banners_part", name="banners_part")
     */
    public function bannersAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('parts/banners.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/admin_sidebar_part_one", name="admin_sidebar_part_one")
     */
    public function adminSidebarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $numCatPh = count($em->getRepository('AppBundle:Categories_phones')->findAll());
        $numCatKi = count($em->getRepository('AppBundle:Categories_kit')->findAll());

        $numBrands = count($em->getRepository('AppBundle:Brands')->findAll());
        $numTags = count($em->getRepository('AppBundle:Tags')->findAll());

        return $this->render('parts/adminsidebar.html.twig', array(
            'numCatP' => $numCatPh,
            'numCatK' => $numCatKi,
            'numBrands' => $numBrands,
            'numTags' => $numTags,
        ));
    }

    /**
     * @Route("/admin_nav_bar", name="admin_nav_bar")
     */
    public function adminNavAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $msgUnread = count($em->getRepository('AppBundle:Inbox')->findBy(array(
            'isRead' => 0
        )));
        $ordUnread = count($em->getRepository('AppBundle:OrderCart')->findBy(array(
            'isRead' => 0
        )));

        $buyUnread = count($em->getRepository('AppBundle:Buying')->findBy(array(
            'isRead' => 0
        )));

        $repUnread = count($em->getRepository('AppBundle:Replacement')->findBy(array(
            'isRead' => 0
        )));

        return $this->render('parts/adminnav.html.twig', array(
            'msg' => $msgUnread,
            'ord' => $ordUnread,
            'buy' => $buyUnread,
            'rep' => $repUnread,
        ));
    }
}