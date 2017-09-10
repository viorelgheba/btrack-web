<?php

namespace AppBundle\Service;

use AppBundle\Dto\BeaconDto;
use AppBundle\Dto\EventDto;
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
        if (empty($eventDto->getBeacons())) {
            return;
        }

        if (count($eventDto->getBeacons()) > 1) {
            $beacons = $this->sortBeaconsByStrength($eventDto->getBeacons());
            $eventDto->setBeacons($beacons);
        }

        $localization = $this->localizationFactory->create($eventDto);
        $localization->handleLocalization();

        $this->doctrine->getManager()->flush();
    }

    /**
     * @param BeaconDto[] $beacons
     *
     * @return BeaconDto[]
     */
    public function sortBeaconsByStrength(array $beacons)
    {
        usort(
            $beacons,
            function (BeaconDto $beaconDto1, BeaconDto $beaconDto2) {
                if ($beaconDto1->getSignalStrength() == $beaconDto2->getSignalStrength()) {
                    return 0;
                }

                return ($beaconDto1->getSignalStrength() > $beaconDto2->getSignalStrength()) ? -1 : 1;
            }
        );

        return $beacons;
    }

    /**
     * @param $doctrine
     *
     * @return $this
     */
    public function setDoctrine($doctrine)
    {
        $this->doctrine = $doctrine;

        return $this;
    }

    /**
     * @param $logger
     *
     * @return $this
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * @param LocalizationFactory $localizationFactory
     *
     * @return EventSaveService
     */
    public function setLocalizationFactory($localizationFactory)
    {
        $this->localizationFactory = $localizationFactory;

        return $this;
    }
}
