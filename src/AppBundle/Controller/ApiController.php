<?php

namespace AppBundle\Controller;

use AppBundle\Service\RabbitMqPublisher;
use AppBundle\Service\RabbitMqPublisherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    /**
     * @Route("/api/event", name="api_event_save", methods={"POST"})
     *
     * @var Request $request
     * @return Response
     */
    public function saveEventAction(Request $request)
    {
        /** @var RabbitMqPublisherInterface $rabbitMqPublisher */
        $rabbitMqPublisher = $this->get(RabbitMqPublisher::ID);

        $rabbitMqPublisher->publish('event.save', $request->getContent());

        return Response::create();
    }
}
