<?php

namespace AppBundle\Service\Localization;

use AppBundle\Dto\BeaconDto;

class TripleLocalization extends AbstractLocalizationService
{
    const ID = 'app_localization_triple';
    const NAME = 'localization_triple';
    const TRIPLE__SIGNAL_LOCALIZATION = 3;

    /**
     * @param BeaconDto[] $beacons
     * @return bool
     */
    public function canLocalize(array $beacons)
    {
        return count($beacons) >= self::TRIPLE__SIGNAL_LOCALIZATION;
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