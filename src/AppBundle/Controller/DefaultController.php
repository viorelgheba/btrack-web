<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @var Request $request
     * @return Response
     *
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return new Response();
    }

    /**
     * @return Response
     *
     * @Route("/events", name="events_list")
     */
    public function eventListAction()
    {
        return $this->render(
            'default/index.html.twig',
            [
                'events' => $this->get('doctrine')->getRepository('AppBundle:Event')->getLatestEvents(),
            ]
        );
    }
}
