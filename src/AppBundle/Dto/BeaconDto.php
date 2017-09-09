<?php

namespace AppBundle\Dto;

class BeaconDto
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $uuid;

    /**
     * @var float
     */
    private $signalStrength;

    /**
     * @var float
     */
    private $distance;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return BeaconDto
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     *
     * @return BeaconDto
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * @return float
     */
    public function getSignalStrength()
    {
        return $this->signalStrength;
    }

    /**
     * @param float $signalStrength
     *
     * @return BeaconDto
     */
    public function setSignalStrength($signalStrength)
    {
        $this->signalStrength = $signalStrength;

        return $this;
    }

    /**
     * @return float
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param float $distance
     *
     * @return BeaconDto
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }
}
