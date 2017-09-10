<?php

namespace AppBundle\Service\Localization;

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
     * @param array $beacons
     * @return AbstractLocalizationService|mixed
     */
    public function create(array $beacons)
    {
        foreach ($this->localisations as $localisation) {
            if (false === $localisation->canLocalize($beacons)) {
                continue;
            }

            $localisation->setBeacons($beacons);
            return $localisation;
        }
    }
}
