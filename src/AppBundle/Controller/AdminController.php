<?php
/**
 * Created by PhpStorm.
 * User: Toka
 * Date: 10/17/17
 * Time: 2:23
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{

    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $catP = $em->getRepository('AppBundle:Categories_phones')->findAll();
        $catK = $em->getRepository('AppBundle:Categories_kit')->findAll();
        $phones = $em->getRepository('AppBundle:Phones')->findAll();
        $eq = $em->getRepository('AppBundle:Equiment')->findAll();
        $cont = $em->getRepository('AppBundle:Inbox')->findAll();
        $brands = $em->getRepository('AppBundle:Brands')->findAll();
        $tags = $em->getRepository('AppBundle:Tags')->findAll();
        $orders = $em->getRepository('AppBundle:OrderCart')->findAll();
        $buy = $em->getRepository('AppBundle:Buying')->findAll();
        $replace = $em->getRepository('AppBundle:Replacement')->findAll();
        $blog = $em->getRepository('AppBundle:Blog')->findAll();

        $reminder = $em->getRepository("AppBundle:Reminder")->findAll();
        $discount = $em->getRepository("AppBundle:Discount")->findAll();

        $emailList = $em->getRepository('AppBundle:EmailList')->findBy(array(), array(), 9);
        $searchList = $em->getRepository('AppBundle:Searches')->findBy(array(), array(), 9);

        //potrebne informacije
        //ukupna vrednost robe na sajtu
        //potencijalna zarada (razlika u cenama - price i my-price)
        //izvestaji za dan i mesec

        return $this->render('admin/index.html.twig', array(
            "brojKatTel" => $catP,
            "brojKatOp" => $catK,
            "brojOglasaTel" => $phones,
            "brojOglasaOp" => $eq,
            "brojPoruka" => $cont,
            "brojBrendova" => $brands,
            "brojTagova" => $tags,
            "brojPorudzbina" => $orders,
            "brojOtkupa" => $buy,
            "brojZamena" => $replace,
            "brojBlogova" => $blog,
            "reminder" => $reminder,
            "discount" => $discount,
            "emailList" => $emailList,
            "searchList" => $searchList,
        ));
    }

    /**
     * @Route("/admin/pregledoglasa", name="adsView")
     */
    public function adsViewAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('admin/ads.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/admin/zamene", name="replaceOffer")
     */
    public function replaceOfferAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('admin/replace.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }


    /**
     * @Route("/admin/otkup", name="buyingOffer")
     */
    public function buyingOfferAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('admin/buy.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/admin/statistic", name="statistic")
     */
    public function statisticAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('admin/statistic.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/admin/sadnuce", name="inboxBox")
     */
    public function inboxBoxAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('admin/inbox.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/admin/blog", name="blogBox")
     */
    public function blogBoxAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('admin/blog.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/admin/emaillista", name="emailList")
     */
    public function emailListAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $emailList = $em->getRepository('AppBundle:EmailList')->findAll();
        return $this->render('admin/emails.html.twig', array(
            'emails' => $emailList,
        ));
    }

    /**
     * @Route("/admin/pretrage", name="searchList")
     */
    public function searchListAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $searchList = $em->getRepository('AppBundle:Searches')->findAll();
        return $this->render('admin/searches.html.twig', array(
            'searches' => $searchList,
        ));
    }
}