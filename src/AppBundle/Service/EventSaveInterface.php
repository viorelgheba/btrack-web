<?php

namespace AppBundle\Service;

use Doctrine\ORM\ORMException;

interface EventSaveInterface
{
    /**
     * @param array $message
     *
     * @throws \InvalidArgumentException
     * @throws ORMException
     */
    public function saveEvent(array $message);
}
