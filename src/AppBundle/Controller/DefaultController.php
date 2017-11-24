<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EmailList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $brands = $em->getRepository('AppBundle:Brands')->findAll();

        //preporuceni
        $phones1 = $em->getRepository('AppBundle:Phones')->findBy(array(), array(
            'id' => 'ASC'
        ), 15);
        //najnoviji telefoni
        $phones2 = $em->getRepository('AppBundle:Phones')->findBy(array(), array(
            'id' => 'DESC'
        ), 15);
        //najnovija oprema
        $equim = $em->getRepository('AppBundle:Equiment')->findBy(array(), array(
            'id' => 'DESC'
        ), 15);
        //blog stuff
        $blog = $em->getRepository('AppBundle:Blog')->findBy(array(), array(
            'id' => 'DESC'
        ), 8);

        return $this->render('default/index.html.twig', array(
            'brands' => $brands,
            'phones1' => $phones1,
            'phones2' => $phones2,
            'equiment' => $equim,
            'blog' => $blog,
        ));
    }

    /**
     * @Route("/onama", name="about")
     */
    public function aboutAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('pages/about.html.twig', array());
    }

    /**
     * @Route("/kakokupiti", name="howtobuy")
     */
    public function howtoAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('pages/howto.html.twig', array());
    }

    /**
     * @Route("/isporukaiplacanje", name="delivery")
     */
    public function deliveryAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('pages/delivery.html.twig', array());
    }

    /**
     * @Route("/zamenaiotkup", name="replacement")
     */
    public function replacementAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('pages/replacement.html.twig', array());
    }

    /**
     * @Route("/pravilaiuslovi", name="terms")
     */
    public function termsAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('pages/terms.html.twig', array());
    }

    /**
     * @Route("/faq", name="faq")
     */
    public function faqAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('pages/faq.html.twig', array());
    }


    /**
     * @Route("/blog", name="blog")
     */
    public function blogAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $blog = $em->getRepository('AppBundle:Blog')->findAll();
        return $this->render('pages/blog.html.twig', array(
            'blog' => $blog,
        ));
    }

    /**
     *
     * Matches /blog/*
     *
     * @Route("/blog/{id}", name="selectedblog")
     */
    public function selectedBlogAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $blog = $em->getRepository('AppBundle:Blog')->findOneBy(array(
            'id' => $id,
        ));
        if(!empty($blog)){

            $data = $em->getRepository('AppBundle:Blog')->findOneBy(array(
                'id' => $id,
            ));
            $data->setViews($data->getViews() + 1);
            $em->flush();

            return $this->render('engine/blog.html.twig', array(
                'blog' => $blog,
            ));
        } else {
            return $this->redirectToRoute('homepage');
        }
    }

    /**
     * @Route("/brendovi", name="brands")
     */
    public function brandAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $brands = $em->getRepository('AppBundle:Brands')->findAll();

        // replace this example code with whatever you need
        return $this->render('pages/brands.html.twig', array(
            'brands' => $brands,
        ));
    }

    /**
     * @Route("/telefoni", name="phones")
     */
    public function phonesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $brands = $em->getRepository('AppBundle:Brands')->findAll();
        $categories = $em->getRepository('AppBundle:Categories_phones')->findAll();
        $phonesBest = $em->getRepository('AppBundle:Phones')->findBy(array(), array(
            'priceOff' => 'DESC',
        ), 9);

        return $this->render('pages/phones.html.twig', array(
            'brands' => $brands,
            'cat' => $categories,
            'object' => $phonesBest,
        ));
    }

    /**
     * @Route("/naprednapretraga", name="supersearch")
     */
    public function superSearchAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('pages/supersearch.html.twig', array());
    }

    /**
     * @Route("/api/newsletter_get", name="newsletter_get")
     */
    public function newsletterAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $mail = $request->request->get('mail');

            $emailList = new EmailList();
            $emailList->setEmail($mail);

            $em = $this->getDoctrine()->getManager();
            $em->persist($emailList);
            $em->flush();

            return new JsonResponse(array(
               'res' => true,
            ));
        }
        return new Response('This is not ajax!', 400);
    }
}
