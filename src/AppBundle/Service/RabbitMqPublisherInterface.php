<?php

namespace AppBundle\Service;

use Symfony\Component\Serializer\Exception\UnexpectedValueException;

interface RabbitMqPublisherInterface
{
    /**
     * @param string     $producerName
     * @param string     $message
     * @param string     $routingKey
     * @param array      $additionalProperties
     * @param array|null $headers
     *
     * @throws \InvalidArgumentException
     */
    public function publish($producerName, $message, $routingKey = '', $additionalProperties = [], array $headers = null);

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
    public function publishArray($producerName, array $decodedMessage, $routingKey = '', $additionalProperties = [], array $headers = null);
}
