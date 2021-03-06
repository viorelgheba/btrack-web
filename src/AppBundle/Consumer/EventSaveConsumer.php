<?php

namespace AppBundle\Consumer;

use AppBundle\Dto\EventDto;
use AppBundle\Service\EventSaveInterface;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;

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
     * @var RegistryInterface
     */
    private $doctrine;

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
        $this->logger->info($msg->body);

        try {
            /** @var EventDto $eventDto */
            $eventDto = $this->serializer->deserialize(
                $msg->body,
                EventDto::class,
                JsonEncoder::FORMAT
            );
        } catch (InvalidArgumentException $e) {
            $this->logger->warning($e->getMessage());

            return self::MSG_REJECT;
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage());

            return self::MSG_REJECT;
        }

        try {
            $this->eventSaveService->saveEvent($eventDto);
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage(), $e->getTrace());

            $this->doctrine->resetManager();

            return self::MSG_REJECT;
        }

        $this->doctrine->getManager()->clear();

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
     * @param RegistryInterface $doctrine
     */
    public function setDoctrine($doctrine)
    {
        $this->doctrine = $doctrine;
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
