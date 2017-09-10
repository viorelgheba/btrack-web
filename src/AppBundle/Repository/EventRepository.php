<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Event;
use Doctrine\ORM\EntityRepository;

class EventRepository extends EntityRepository
{
    /**
     * @return Event[]
     */
    public function getLatestEvents()
    {
        return $this->createQueryBuilder('e')
            ->select('PARTIAL e.{id,positionOx,positionOy,eventDatetime}')
            ->orderBy('e.eventDatetime', 'desc')
            ->setMaxResults(20)
            ->getQuery()
            ->useQueryCache(true)
            ->getResult();
    }
}
