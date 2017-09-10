<?php

namespace AppBundle\Service\Localization;

use AppBundle\Dto\BeaconDto;
use AppBundle\Dto\EventDto;
use AppBundle\Entity\Beacon;
use AppBundle\Repository\BeaconRepository;

class TripleLocalization extends AbstractLocalizationService
{
    const ID = 'app_localization_triple';
    const NAME = 'localization_triple';
    const TRIPLE_SIGNAL_LOCALIZATION = 3;

    /**
     * @param BeaconDto[] $beacons
     * @return bool
     */
    public function canLocalize(array $beacons)
    {
        return count($beacons) >= self::TRIPLE_SIGNAL_LOCALIZATION;
    }

    /**
     * returns client location
     *
     * @param EventDto $eventDto
     * @param Beacon[] $beacons
     *
     * @return array
     */
    public function handleLocalization(EventDto $eventDto, $beacons)
    {
        $this->generateNewEvent($eventDto, $beacons[0]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }
}
