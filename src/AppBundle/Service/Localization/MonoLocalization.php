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

    public function handleLocalization()
    {
        /** @var BeaconRepository $beaconRepository */
        $beaconRepository = $this->getDoctrine()->getRepository('AppBundle:Beacon');

        /** @var Beacon $beacon */
        foreach ($this->getEventDto()->getBeacons() as $foundBeacon) {
            $beacon = $beaconRepository->findOneBy(
                array(
                    'uuid' => $foundBeacon->getUuid(),
                )
            );

            if (null === $beacon) {
                continue;
            }

            $this->generateNewEvent($this->getEventDto(), $beacon);
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }
}