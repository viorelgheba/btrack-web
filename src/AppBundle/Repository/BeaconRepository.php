<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Beacon;
use Doctrine\ORM\EntityRepository;

class BeaconRepository extends EntityRepository
{
    /**
     * @param array $uuids
     *
     * @return Beacon[]
     */
    public function findByUuid($uuids)
    {
        return $this->createQueryBuilder('b')
            ->where('b.uuid in (:uuids)')->setParameter('uuids', $uuids)
            ->andWhere('b.status = :status')->setParameter('status', Beacon::STATUS_ACTIVE)
            ->getQuery()
            ->useQueryCache(true)
            ->getResult();
    }
}
