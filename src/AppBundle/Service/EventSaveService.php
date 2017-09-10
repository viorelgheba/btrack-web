<?php

namespace AppBundle\Service;

use AppBundle\Dto\BeaconDto;
use AppBundle\Dto\EventDto;
use AppBundle\Entity\Beacon;
use AppBundle\Repository\BeaconRepository;
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

        /** @var BeaconRepository $beaconRepository */
        $beaconRepository = $this->doctrine->getRepository('AppBundle:Beacon');

        $beacons = $beaconRepository->findByUuid(
            array_map(
                function (BeaconDto $b) {
                    return $b->getUuid();
                },
                $eventDto->getBeacons()
            )
        );

        if (empty($beacons)) {
            return;
        }

        $uuids = array_map(
            function (Beacon $b) {
                return $b->getUuid();
            },
            $beacons
        );

        $eventDto->setBeacons(
            array_values(
                array_filter(
                    $eventDto->getBeacons(),
                    function (BeaconDto $b) use ($uuids) {
                        return in_array($b->getUuid(), $uuids);
                    }
                )
            )
        );

        if (count($eventDto->getBeacons()) > 1) {
            usort(
                $eventDto->getBeacons(),
                function (BeaconDto $beaconDto1, BeaconDto $beaconDto2) {
                    if ($beaconDto1->getSignalStrength() == $beaconDto2->getSignalStrength()) {
                        return 0;
                    }

                    return ($beaconDto1->getSignalStrength() > $beaconDto2->getSignalStrength()) ? -1 : 1;
                }
            );
        }

        $this->localizationFactory->create($eventDto)
            ->handleLocalization($eventDto, $beacons);

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
    }

    /**
     * @param $logger
     *
     * @return $this
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param LocalizationFactory $localizationFactory
     *
     * @return EventSaveService
     */
    public function setLocalizationFactory($localizationFactory)
    {
        $this->localizationFactory = $localizationFactory;
    }
}
