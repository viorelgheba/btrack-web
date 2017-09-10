<?php

namespace AppBundle\Service\Localization;

use AppBundle\Dto\BeaconDto;
use AppBundle\Dto\EventDto;
use AppBundle\Entity\Beacon;
use AppBundle\Repository\BeaconRepository;

class DualLocalization extends AbstractLocalizationService
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