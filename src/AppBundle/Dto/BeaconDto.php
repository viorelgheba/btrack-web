<?php

namespace AppBundle\Dto;

class BeaconDto
{
    const UNKNOWN = 'unknown';
    const IMMEDIATE = 'immediate';
    const NEAR = 'near';
    const FAR = 'far';

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
     * @var string
     */
    private $zone;

    /**
     * @var float
     */
    private $x;

    /**
     * @var float
     */
    private $y;

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
    public function setName(string $name): BeaconDto
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
    public function setUuid(string $uuid): BeaconDto
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
    public function setSignalStrength(float $signalStrength): BeaconDto
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
    public function setDistance(float $distance): BeaconDto
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * @return string
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * @param string $zone
     *
     * @return BeaconDto
     */
    public function setZone(string $zone): BeaconDto
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * @return float
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param float $x
     *
     * @return BeaconDto
     */
    public function setX(float $x): BeaconDto
    {
        $this->x = $x;

        return $this;
    }

    /**
     * @return float
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param float $y
     *
     * @return BeaconDto
     */
    public function setY(float $y): BeaconDto
    {
        $this->y = $y;

        return $this;
    }
}
