<?php

namespace AppBundle\Service\Localization;

use AppBundle\Dto\BeaconDto;
use AppBundle\Dto\EventDto;

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
     * @param EventDto[] $beacons
     * @return array
     */
    public function handleLocalization(array $beacons);

    /**
     * @return string
     */
    public function getName();
}