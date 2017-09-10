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
     * @return array
     */
    public function handleLocalization();

    /**
     * @return string
     */
    public function getName();
}