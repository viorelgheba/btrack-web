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
     * @var EventDto
     */
    protected $eventDto;


    protected function generateNewEvent(EventDto $eventDto, Beacon $beacon)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $event = new Event();
        $event->setShowroom($beacon->getShowroom());
        $event->setCreated(new \DateTime('now'));
        $event->setEventDatetime($eventDto->getTimestamp());
        $event->setPositionOx($beacon->getPositionOx());
        $event->setPositionOy($beacon->getPositionOy());

        $em->persist($event);
    }

    /**
     * @return Registry
     */
    public function getDoctrine()
    {
        return $this->doctrine;
    }

    /**
     * @param Registry $doctrine
     * @return AbstractLocalizationService
     */
    public function setDoctrine($doctrine)
    {
        $this->doctrine = $doctrine;
        return $this;
    }

    /**
     * @return EventDto
     */
    public function getEventDto(): EventDto
    {
        return $this->eventDto;
    }

    /**
     * @param EventDto $eventDto
     * @return AbstractLocalizationService
     */
    public function setEventDto(EventDto $eventDto): AbstractLocalizationService
    {
        $this->eventDto = $eventDto;
        return $this;
    }
}