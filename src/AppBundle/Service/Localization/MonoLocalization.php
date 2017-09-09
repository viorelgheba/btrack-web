<?php

namespace AppBundle\Service\Localization;

use AppBundle\Dto\BeaconDto;

class MonoLocalization extends AbstractLocalizationService
{
    const ID = 'app_localization_mono';
    const NAME = 'localization_mono';
    const MONO_SIGNAL_LOCALIZATION = 1;

    /**
     * @param BeaconDto[] $beacons
     * @return bool
     */
    public function canLocalize(array $beacons)
    {
        return count($beacons) == self::MONO_SIGNAL_LOCALIZATION;
    }

    /**
     * returns client location
     *
     * @param BeaconDto[] $beacons
     * @return array
     */
    public function handleLocalization(array $beacons)
    {
        /** @var BeaconRepository $beaconRepository */
        $beaconRepository = $this->getDoctrine()->getRepository('AppBundle:Beacon');

        $beacon = $beaconRepository->findOneBy(
            array (
                'uuid' => $beacons[0]->getUuid()
            )
        );

        return $beacon->getLocation();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }
}