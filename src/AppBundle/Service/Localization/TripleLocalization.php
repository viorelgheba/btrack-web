<?php

namespace AppBundle\Service\Localization;

use AppBundle\Dto\BeaconDto;
use AppBundle\Entity\Beacon;
use AppBundle\Repository\BeaconRepository;

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
     * @return array
     */
    public function handleLocalization()
    {
        /** @var BeaconRepository $beaconRepository */
        $beaconRepository = $this->getDoctrine()->getRepository('AppBundle:Beacon');

        /** @var Beacon $beacon */
        $beacon = $beaconRepository->findOneBy(
            array (
                'uuid' => $this->getEventDto()->getBeacons()[0]->getUuid()
            )
        );

        $this->generateNewEvent($this->getEventDto(), $beacon);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }
}