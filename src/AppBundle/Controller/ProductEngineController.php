<?php
/**
 * Created by PhpStorm.
 * User: Toka
 * Date: 11/1/17
 * Time: 0:07
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductEngineController extends Controller
{

    /**
     *
     * Matches /telefon/*
     *
     * @Route("/telefon/{mark}/{model}/{id}", name="choosed_phone")
     */
    public function phFindAction($mark, $model, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $phone = $em->getRepository('AppBundle:Phones')->findOneBy(array(
            'id' => $id
        ));

        //slicni telefoni
        $relPhone = $em->getRepository('AppBundle:Phones')->findBy(array(
            'mark' => $phone->getMark(),
        ));

        //predlozena oprema
        $relEq = $em->getRepository("AppBundle:Equiment")->findAll(array(),array(),9);

        // replace this example code with whatever you need
        return $this->render('engine/product.html.twig', array(
            'object' => $phone,
            'relphone' => $relPhone,
            'releq' => $relEq,
            'o' => 'p',
        ));
    }

    /**
     *
     * Matches /oprema/*
     *
     * @Route("/oprema/{mark}/{name}/{id}", name="choosed_kit")
     */

    public function eqFindAction($mark, $name, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $phone = $em->getRepository('AppBundle:Equiment')->findOneBy(array(
            'id' => $id
        ));

        //predlozeni telefoni
        $relPhone = $em->getRepository('AppBundle:Phones')->findBy(array(), array(), 6);

        //jos opreme
        $relEq = $em->getRepository("AppBundle:Equiment")->findAll(array(),array(),9);

        // replace this example code with whatever you need
        return $this->render('engine/product.html.twig', array(
            'object' => $phone,
            'relphone' => $relPhone,
            'releq' => $relEq,
            'o' => 'e',
        ));
    }

}