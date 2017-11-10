<?php
/**
 * Created by PhpStorm.
 * User: Toka
 * Date: 11/5/17
 * Time: 17:48
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ApiController extends Controller
{

    // CART

    //test

    /**
     * @Route("/ajaxdatabinding", name="ajaxdatabinding")
     *
     * @Method({"GET", "POST"})
     */

    public function indexAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            return new JsonResponse(array(
                'data' => 'this is a json response'
            ));
        }

        return new Response('This is not ajax!', 400);
    }
}