<?php

namespace AppBundle\Service\Localization;

use AppBundle\Dto\EventDto;
use AppBundle\Entity\Beacon;
use AppBundle\Entity\Event;
use AppBundle\Repository\CustomerRepository;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;

abstract class AbstractLocalizationService implements LocalizationInterface
{
    /**
     * @var Registry
     */
    protected $doctrine;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param EventDto   $eventDto
     * @param Beacon     $beacon
     * @param float|null $x
     * @param float|null $y
     */
    protected function generateNewEvent(EventDto $eventDto, Beacon $beacon, $x = null, $y = null)
    {
        /** @var EntityManager $em */
        $em = $this->doctrine->getManager();

        $event = new Event();

        $event->setShowroom($beacon->getShowroom())
            ->setCreated(new \DateTime('now'))
            ->setEventDatetime($eventDto->getTimestamp())
            ->setPositionOx(null === $x ? $beacon->getPositionOx() : $x)
            ->setPositionOy(null === $y ? $beacon->getPositionOy() : $y);

        $em->persist($event);

        $this->logger->info("Coordinates: X:" . $x . "  Y:" . $y);
    }

    /**
     * @param Registry $doctrine
     * @return AbstractLocalizationService
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
