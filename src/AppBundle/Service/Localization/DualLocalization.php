<?php

namespace AppBundle\Service\Localization;

use AppBundle\Dto\BeaconDto;

class DualLocalization implements LocalizationInterface
{
    const ID = 'app_localization_dual';
    const DUAL_SIGNAL_LOCALIZATION = 2;
    const NAME = 'localization_dual';

    /**
     * @param BeaconDto[] $beacons
     * @return bool
     */
    public function canLocalize(array $beacons)
    {
        return count($beacons) == self::DUAL_SIGNAL_LOCALIZATION;
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