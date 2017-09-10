<?php

namespace AppBundle\Service\Localization;

use AppBundle\Dto\BeaconDto;
use AppBundle\Dto\EventDto;
use AppBundle\Entity\Beacon;

interface LocalizationInterface
{
    /**
     * @param BeaconDto[] $beacons
     * @return bool
     */
    public function canLocalize(array $beacons);

    /**
     * returns client location
     *
     * @param EventDto $eventDto
     * @param Beacon[] $beacons
     */
    public function handleLocalization(EventDto $eventDto, $beacons);

    /**
     * @return string
     */
    public function getName();
}
