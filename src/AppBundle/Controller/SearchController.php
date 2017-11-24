<?php
/**
 * Created by PhpStorm.
 * User: Toka
 * Date: 11/22/17
 * Time: 14:29
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Searches;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\OrderCart;


class SearchController extends Controller
{
    /**
     * @Route("/pretraga", name="search_article_user")
     */

    public function indexAction(Request $request)
    {
        $search = $request->query->get('search_val');
        $search_cat = $request->query->get('search_category');

        $search_array = explode(' ', $search);

        $em = $this->getDoctrine()->getManager();

        //put search in DB
        $searchEntity = new Searches();
        $searchEntity->setSearch($search);
        $em->persist($searchEntity);
        $em->flush();

        //find : 0 - telefoni; 1 - oprema; 2 - blog

        $res = [];

        if($search_cat == 0){
            foreach ($search_array as $s){
                $query = $em->createQuery('SELECT p FROM AppBundle:Phones p WHERE p.mark LIKE :data OR p.model LIKE :data')->setParameter('data',$s);
                $res = $query->getResult();
            }
            $search_cat_name = 'Telefoni';
            $search_pass = 'p';
        } else {
            foreach ($search_array as $s) {
                $query = $em->createQuery('SELECT e FROM AppBundle:Equiment e WHERE e.mark LIKE :data OR e.name LIKE :data')->setParameter('data', $s);
                $res = $query->getResult();
            }
            $search_cat_name = 'Oprema';
            $search_pass = 'notp';
        }

        return $this->render('pages/search.html.twig', array(
            'search' => $search,
            'search_cat' => $search_cat_name,
            'result' => $res,
            'o' => $search_pass,
        ));
    }
}