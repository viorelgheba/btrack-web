<?php

namespace AppBundle\Consumer;

use AppBundle\Service\EventSaveInterface;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class EventSaveConsumer implements ConsumerInterface
{
    /**
     * @var EventSaveInterface
     */
    private $eventSaveService;

    /**
     * @param AMQPMessage $msg The message
     *
     * @return mixed false to reject and requeue, any other value to acknowledge
     */
    public function execute(AMQPMessage $msg)
    {
        // decode message into dto
        // call event service with dto
        // return action

        return self::MSG_ACK;
    }

    /**
     * @param EventSaveInterface $eventSaveService
     */
    public function setEventSaveService($eventSaveService)
    {
        $this->eventSaveService = $eventSaveService;
    }
}
