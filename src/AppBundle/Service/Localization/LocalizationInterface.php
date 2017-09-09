<?php

namespace AppBundle\Service\Localization;

use AppBundle\Dto\BeaconDto;

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
     * @param BeaconDto[] $beacons
     * @return array
     */
    public function handleLocalization(array $beacons);

    /**
     * @return string
     */
    public function getName();
}