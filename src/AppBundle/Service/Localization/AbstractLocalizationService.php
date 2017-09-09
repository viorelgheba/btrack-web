<?php

namespace AppBundle\Service\Localization;

use AppBundle\Dto\BeaconDto;
use Doctrine\Bundle\DoctrineBundle\Registry;

abstract class AbstractLocalizationService implements LocalizationInterface
{
    /**
     * @var Registry
     */
    protected $doctrine;

    /**
     * @var BeaconDto[]
     */
    protected $beacons;

    /**
     * @return Registry
     */
    public function getDoctrine()
    {
        return $this->doctrine;
    }

    /**
     * @param Registry $doctrine
     * @return AbstractLocalizationService
     */
    public function setDoctrine($doctrine)
    {
        $this->doctrine = $doctrine;
        return $this;
    }

    /**
     * @return BeaconDto[]
     */
    public function getBeacons(): array
    {
        return $this->beacons;
    }

    /**
     * @param BeaconDto[] $beacons
     * @return AbstractLocalizationService
     */
    public function setBeacons(array $beacons): AbstractLocalizationService
    {
        $this->beacons = $beacons;
        return $this;
    }
}