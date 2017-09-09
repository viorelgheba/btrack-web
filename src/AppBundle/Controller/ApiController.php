<?php

namespace AppBundle\Controller;

use AppBundle\Service\RabbitMqPublisher;
use AppBundle\Service\RabbitMqPublisherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    /**
     * @var Request $request
     *
     * @Route("/api/event", methods={POST})
     */
    public function saveEventAction(Request $request)
    {
        /** @var RabbitMqPublisherInterface $rabbitMqPublisher */
        $rabbitMqPublisher = $this->get(RabbitMqPublisher::ID);

        $rabbitMqPublisher->publish('event.save', $request->getContent());

        return Response::create();
    }
}
