<?php

namespace AppBundle\Service;

use AppBundle\Dto\BeaconDto;
use AppBundle\Dto\EventDto;
use AppBundle\Entity\Event;
use AppBundle\Service\Localization\LocalizationFactory;
use Doctrine\ORM\ORMException;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

class EventSaveService implements EventSaveInterface
{
    /**
     * @var RegistryInterface
     */
    private $doctrine;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var LocalizationFactory
     */
    private $localizationFactory;

    /**
     * @param EventDto $eventDto
     *
     * @throws \InvalidArgumentException
     * @throws ORMException
     */
    public function saveEvent(EventDto $eventDto)
    {
        return;
        if (empty($eventDto->getBeacons())) {
            return;
        }

        $beacons = $this->sortBeaconsByStrength($eventDto->getBeacons());
        $eventDto->setBeacons($beacons);

        $localization = $this->localizationFactory->create($beacons);
        $localization->handleLocalization($beacons);
    }

    /**
     * @param BeaconDto[] $beacons
     * @return BeaconDto[]
     */
    public function sortBeaconsByStrength(array $beacons)
    {
        return usort($beacons, "cmp_beacons");
    }

    static function cmp_beacons(BeaconDto $beaconDto1, BeaconDto $beaconDto2)
    {
        if ($beaconDto1->getSignalStrength() == $beaconDto2->getSignalStrength()) {
            return 0;
        }

        return ($beaconDto1->getSignalStrength() < $beaconDto2->getSignalStrength()) ? -1 : 1;
    }

    /**
     * @param RegistryInterface $doctrine
     */
    public function setDoctrine($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }
}
