<?php
/**
 * Created by PhpStorm.
 * User: Toka
 * Date: 11/15/17
 * Time: 11:00
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Reminder;
use Symfony\Component\HttpFoundation\JsonResponse;

class ReminderController extends Controller
{
    /**
     * @Route("/reminder/add_new", name="add_new_reminder")
     *
     * @Method({"GET", "POST"})
     */

    public function addReminderAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $txt = $request->request->get('txt');
            $created_at = new \DateTime();

            $reminder = new Reminder();
            $reminder->setName($txt);
            $reminder->setCreatedAt($created_at);

            $em = $this->getDoctrine()->getManager();
            $em->persist($reminder);
            $em->flush();

            return new JsonResponse(array(
                'id' => $reminder->getId(),
                'name' => $reminder->getName(),
                'month' => date_format($reminder->getCreatedAt(), 'M'),
                'day' => date_format($reminder->getCreatedAt(), 'd'),
            ));
        }

        return new Response('This is not ajax!', 400);
    }

    /**
     * @Route("/reminder/del_reminder", name="del_reminder")
     *
     * @Method({"GET", "POST"})
     */

    public function delReminderAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {

            $id = $request->request->get('id');
            $em = $this->getDoctrine()->getManager();
            $reminder = $em->getRepository('AppBundle:Reminder')->findOneBy(array(
                'id' => $id,
            ));
            if($reminder != null){
                $em->remove($reminder);
                $em->flush();
            }
            return new JsonResponse(array());
        }
    }
}