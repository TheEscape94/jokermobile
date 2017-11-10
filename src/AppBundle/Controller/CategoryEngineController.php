<?php
/**
 * Created by PhpStorm.
 * User: Toka
 * Date: 11/1/17
 * Time: 0:06
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryEngineController extends Controller
{
    //pronalazenje proizvoda za odredjenu kategoriju telefona

    /**
     *
     * Matches /kategorija/*
     *
     * @Route("/kategorija/{cat}", name="category")
     */
    public function indexAction($cat)
    {
        $em = $this->getDoctrine()->getManager();
        $phonesIn = $em->getRepository('AppBundle:Phones')->findBy(array(
            'mark' => $cat,
        ), array(
            'id' => 'DESC',
        ));
        $phonesInBest = $em->getRepository('AppBundle:Phones')->findBy(array(
            'mark' => $cat,
        ), array(
            'priceOff' => 'DESC',
        ), 5);

        return $this->render('engine/category.html.twig', array(
            'cat' => $cat,
            'object' => $phonesIn,
            'objectBest' => $phonesInBest,
            'o' => 'p',
        ));
    }

    //nije izabrana nijedna kategorija
    /**
     *
     * @Route("/kategorija", name="no_category")
     *
     */
    public function indexCatAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('engine/category.html.twig', array());
    }

    //oprema, pronalazenje opreme po id-u

    /**
     * @Route("/oprema", name="kit")
     */
    public function kitAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository('AppBundle:Categories_kit')->findBy(array(), array(
            'id' => 'DESC',
        ));

        $equiment = $em->getRepository('AppBundle:Equiment')->findBy(array(), array(
            'priceOff' => 'DESC',
        ), 9);

        return $this->render('pages/kit.html.twig', array(
            'eq' => $cat,
            'equiment' => $equiment,
        ));
    }

    /**
     *
     * Matches /oprema/kategorija/*
     *
     * @Route("/oprema/kategorija/{op}", name="choosed_kit")
     */
    public function choosedKitAction($op)
    {
        $em = $this->getDoctrine()->getManager();
        $eqIn = $em->getRepository('AppBundle:Equiment')->findBy(array(
            'category' => $op,
        ), array(
            'id' => 'DESC',
        ));
        $eqBest = $em->getRepository('AppBundle:Equiment')->findBy(array(
            'category' => $op,
        ), array(
            'priceOff' => 'DESC',
        ));
        $catName = $em->getRepository('AppBundle:Categories_kit')->findOneBy(array(
            'id' => $op,
        ));

        // replace this example code with whatever you need
        return $this->render('engine/category.html.twig', array(
            'object' => $eqIn,
            'objectBest' => $eqBest,
            'cat' => $catName->getName(),
            'o' => 'e',
        ));
    }

    /**
     *
     * Matches /tagovi/*
     *
     * @Route("/tagovi/{tag}", name="chosed_tags")
     */
    public function choosedTagAction($tag)
    {
        $em = $this->getDoctrine()->getManager();
        $phones = $em->getRepository('AppBundle:Phones')->findAll(array());



        // replace this example code with whatever you need
        return $this->render('engine/tags.html.twig', array());
    }

}