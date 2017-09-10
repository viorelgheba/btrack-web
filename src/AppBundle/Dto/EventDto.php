<?php

namespace AppBundle\Dto;

class EventDto
{
    /**
     * @var BeaconDto[]
     */
    private $beacons = [];

    /**
     * @var \DateTime
     */
    private $timestamp;

    /**
     * @return BeaconDto[]
     */
    public function getBeacons()
    {
        return $this->beacons;
    }

    /**
     * @param BeaconDto[] $beacons
     *
     * @return EventDto
     */
    public function setBeacons($beacons): EventDto
    {
        $this->beacons = $beacons;

        return $this;
    }

    /**
     * @param BeaconDto $beaconDto
     *
     * @return EventDto
     */
    public function addBeacon(BeaconDto $beaconDto): EventDto
    {
        $this->beacons[] = $beaconDto;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param \DateTime $timestamp
     *
     * @return EventDto
     */
    public function setTimestamp($timestamp): EventDto
    {
        $this->timestamp = $timestamp;

        return $this;
    }
}
