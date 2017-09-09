<?php

namespace AppBundle\Consumer;

use AppBundle\Dto\EventDto;
use AppBundle\Service\EventSaveInterface;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class EventSaveConsumer implements ConsumerInterface
{
    /**
     * @var EventSaveInterface
     */
    private $eventSaveService;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param AMQPMessage $msg The message
     *
     * @return mixed false to reject and requeue, any other value to acknowledge
     */
    public function execute(AMQPMessage $msg)
    {
        try {
            /** @var EventDto $eventDto */
            $eventDto = $this->serializer->deserialize(
                $msg->body,
                EventDto::class,
                JsonEncoder::FORMAT
            );

            $this->eventSaveService->saveEvent($eventDto);
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage(), ['message' => $msg->body]);

            return self::MSG_REJECT;
        }

        return self::MSG_ACK;
    }

    /**
     * @param EventSaveInterface $eventSaveService
     */
    public function setEventSaveService($eventSaveService)
    {
        $this->eventSaveService = $eventSaveService;
    }

    /**
     * @param SerializerInterface $serializer
     */
    public function setSerializer($serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }
}
