<?php

namespace AppBundle\Service\Localization;

use AppBundle\Dto\EventDto;
use AppBundle\Entity\Beacon;
use AppBundle\Entity\Event;
use AppBundle\Repository\CustomerRepository;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;

abstract class AbstractLocalizationService implements LocalizationInterface
{
    /**
     * @var Registry
     */
    protected $doctrine;

    /**
     * @param EventDto $eventDto
     * @param Beacon   $beacon
     */
    protected function generateNewEvent(EventDto $eventDto, Beacon $beacon)
    {
        /** @var EntityManager $em */
        $em = $this->doctrine->getManager();

        $event = new Event();

        $event->setShowroom($beacon->getShowroom())
            ->setCreated(new \DateTime('now'))
            ->setEventDatetime($eventDto->getTimestamp())
            ->setPositionOx($beacon->getPositionOx())
            ->setPositionOy($beacon->getPositionOy());

        $em->persist($event);
    }

    /**
     * @param Registry $doctrine
     * @return AbstractLocalizationService
     */
    public function setDoctrine($doctrine)
    {
        $this->doctrine = $doctrine;
    }
}
