<?php

namespace AppBundle\Service;

use OldSound\RabbitMqBundle\RabbitMq\Producer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;

class RabbitMqPublisher implements RabbitMqPublisherInterface
{
    const ID = 'rabbitmq_publisher';

    /**
     * @var Producer[]
     */
    private $producers = [];

    /**
     * @var JsonEncoder
     */
    private $encoder;

    /**
     * @param string     $producerName
     * @param string     $message
     * @param string     $routingKey
     * @param array      $additionalProperties
     * @param array|null $headers
     *
     * @throws \InvalidArgumentException
     */
    public function publish($producerName, $message, $routingKey = '', $additionalProperties = [], array $headers = null)
    {
        $producerId = sprintf('old_sound_rabbit_mq.%s_producer', $producerName);
        if (!isset($this->producers[$producerId])) {
            throw new \InvalidArgumentException(sprintf('Could not find producer %s', $producerName));
        }

        $producer = $this->producers[$producerId];
        $producer->publish($message, $routingKey, $additionalProperties, $headers);
    }

    /**
     * @param string     $producerName
     * @param array      $decodedMessage
     * @param string     $routingKey
     * @param array      $additionalProperties
     * @param array|null $headers
     *
     * @throws UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    public function publishArray($producerName, array $decodedMessage, $routingKey = '', $additionalProperties = [], array $headers = null)
    {
        $encodedMessage = $this->encoder->encode($decodedMessage, JsonEncoder::FORMAT);

        $this->publish($producerName, $encodedMessage, $routingKey, $additionalProperties, $headers);
    }

    /**
     * @param string   $id
     * @param Producer $producer
     */
    public function addProducer($id, Producer $producer)
    {
        $this->producers[$id] = $producer;
    }

    /**
     * @param JsonEncoder $encoder
     */
    public function setEncoder($encoder)
    {
        $this->encoder = $encoder;
    }
}
