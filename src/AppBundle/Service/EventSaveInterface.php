<?php

namespace AppBundle\Service;

use AppBundle\Dto\EventDto;
use Doctrine\ORM\ORMException;

interface EventSaveInterface
{
    /**
     * @param EventDto $eventDto
     *
     * @throws \InvalidArgumentException
     * @throws ORMException
     */
    public function saveEvent(EventDto $eventDto);
}
