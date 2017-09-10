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
            ->orderBy('e.eventDatetime', 'desc')
            ->setMaxResults(10)
            ->getQuery()
            ->useQueryCache(true)
            ->getResult();
    }
}
