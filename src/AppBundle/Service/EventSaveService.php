<?php

namespace AppBundle\Service;

use AppBundle\Dto\EventDto;
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
     * @param EventDto $eventDto
     *
     * @throws \InvalidArgumentException
     * @throws ORMException
     */
    public function saveEvent(EventDto $eventDto)
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
