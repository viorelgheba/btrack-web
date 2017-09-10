<?php

namespace AppBundle\Service\Localization;

use AppBundle\Dto\BeaconDto;
use AppBundle\Dto\EventDto;
use AppBundle\Entity\Beacon;
use AppBundle\Repository\BeaconRepository;

class MonoLocalization extends AbstractLocalizationService
{
    const ID                       = 'app_localization_mono';
    const NAME                     = 'localization_mono';
    const MONO_SIGNAL_LOCALIZATION = 1;

    /**
     * @param BeaconDto[] $beacons
     *
     * @return bool
     */
    public function canLocalize(array $beacons)
    {
        return count($beacons) == self::MONO_SIGNAL_LOCALIZATION;
    }

    /**
     * returns client location
     *
     * @param EventDto $eventDto
     * @param Beacon[] $beacons
     */
    public function handleLocalization(EventDto $eventDto, $beacons)
    {
        $this->generateNewEvent($eventDto, $beacons[0], $beacons[0]->getPositionOx(), $beacons[0]->getPositionOy());
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }
}
