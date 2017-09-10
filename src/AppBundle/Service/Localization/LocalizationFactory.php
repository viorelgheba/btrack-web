<?php

namespace AppBundle\Service\Localization;

use AppBundle\Dto\EventDto;
use Doctrine\Common\Collections\ArrayCollection;

class LocalizationFactory
{
    /**
     * @var AbstractLocalizationService[]
     */
    protected $localisations;

    public function __construct()
    {
        $this->localisations = new ArrayCollection();
    }

    /**
     * @return AbstractLocalizationService[]
     */
    public function getLocalisations(): array
    {
        return $this->localisations;
    }

    /**
     * @param LocalizationInterface $localisation
     * @return LocalizationFactory
     */
    public function addLocalization(LocalizationInterface $localisation): LocalizationFactory
    {
        $this->localisations->set($localisation->getName(), $localisation);

        return $this;
    }

    /**
     * @param EventDto $eventDto
     * @return AbstractLocalizationService|mixed
     */
    public function create(EventDto $eventDto)
    {
        foreach ($this->localisations as $localisation) {
            if (false === $localisation->canLocalize($eventDto->getBeacons())) {
                continue;
            }

            $localisation->setEventDto($eventDto);
            return $localisation;
        }
    }
}
