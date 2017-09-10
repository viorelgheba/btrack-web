<?php

namespace AppBundle\Service\Localization;

use AppBundle\Dto\BeaconDto;
use AppBundle\Dto\EventDto;
use AppBundle\Entity\Beacon;
use AppBundle\Repository\BeaconRepository;

class TripleLocalization extends AbstractLocalizationService
{
    const ID = 'app_localization_triple';
    const NAME = 'localization_triple';
    const TRIPLE_SIGNAL_LOCALIZATION = 3;
    const CALIBRATE_DISTANCE = 5;

    /**
     * @param BeaconDto[] $beacons
     * @return bool
     */
    public function canLocalize(array $beacons)
    {
        return count($beacons) >= self::TRIPLE_SIGNAL_LOCALIZATION;
    }

    /**
     * returns client location
     *
     * @param EventDto $eventDto
     * @param Beacon[] $beacons
     */
    public function handleLocalization(EventDto $eventDto, $beacons)
    {
        /** @var BeaconDto[] $bs */
        $bs = array_slice($eventDto->getBeacons(), 0, 3);

        foreach ($bs as $b) {
            foreach ($beacons as $beacon) {
                if ($beacon->getUuid() === $b->getUuid()) {
                    $b->setX($beacon->getPositionOx())
                        ->setY($beacon->getPositionOy());
                }
            }
        }

        $b1 = $bs[0];
        $b1->setSignalStrength(
            abs($b1->getSignalStrength()) / self::CALIBRATE_DISTANCE
        );

        $b2 = $bs[1];
        $b2->setSignalStrength(
            abs($b2->getSignalStrength()) / self::CALIBRATE_DISTANCE
        );

        $b3 = $bs[2];
        $b3->setSignalStrength(
            abs($b3->getSignalStrength()) / self::CALIBRATE_DISTANCE
        );

        $x = ($b2->getX() - $b3->getX())
            * (
                (pow($b2->getX(), 2) - pow($b1->getX(), 2))
                + (pow($b2->getY(), 2) - pow($b1->getY(), 2))
                /*+ (pow($b1->getSignalStrength(), 2) - pow($b2->getSignalStrength(), 2))*/
            )
            - ($b1->getX() - $b2->getX())
            * (
                (pow($b3->getX(), 2) - pow($b2->getX(), 2))
                + (pow($b3->getY(), 2) - pow($b2->getY(), 2))
                /*+ (pow($b2->getSignalStrength(), 2) - pow($b3->getSignalStrength(), 2))*/
            )
            / (
                2
                * (
                    ($b1->getY() - $b2->getY()) * ($b2->getX() - $b3->getX()) - ($b2->getY() - $b3->getY()) * ($b1->getX() - $b2->getX())
                )
            );

        $y = ($b2->getY() - $b3->getY())
            * (
                (pow($b2->getY(), 2) - pow($b1->getY(), 2))
                + (pow($b2->getX(), 2) - pow($b1->getX(), 2))
                /*+ (pow($b1->getSignalStrength(), 2) - pow($b2->getSignalStrength(), 2))*/
            )
            - ($b1->getY() - $b2->getY())
            * (
                (pow($b3->getY(), 2) - pow($b2->getY(), 2))
                + (pow($b3->getX(), 2) - pow($b2->getX(), 2))
                /*+ (pow($b2->getSignalStrength(), 2) - pow($b3->getSignalStrength(), 2))*/
            )
            / (
                2
                * (
                    ($b1->getX() - $b2->getX()) * ($b2->getY() - $b3->getY()) - ($b2->getX() - $b3->getX()) * ($b1->getY() - $b2->getY())
                )
            );

        $this->generateNewEvent($eventDto, $beacons[0], $x, $y);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }
}
