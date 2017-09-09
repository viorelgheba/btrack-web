<?php

namespace AppBundle\Service;

use Doctrine\ORM\ORMException;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

class EventSaveService implements EventSaveInterface
{
    /**
     * @var RegistryInterface
     */
    private $doctrine;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param array $message
     *
     * @throws \InvalidArgumentException
     * @throws ORMException
     */
    public function saveEvent(array $message)
    {
        // TODO: Implement saveEvent() method.
    }

    /**
     * @param RegistryInterface $doctrine
     */
    public function setDoctrine($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }
}
