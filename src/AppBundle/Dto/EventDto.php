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
     * @var int
     */
    private $clientId;

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
    public function setBeacons($beacons)
    {
        $this->beacons = $beacons;

        return $this;
    }

    /**
     * @param BeaconDto $beaconDto
     *
     * @return EventDto
     */
    public function addBeacon(BeaconDto $beaconDto)
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
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * @return int
     */
    public function getClientId(): int
    {
        return $this->clientId;
    }

    /**
     * @param int $clientId
     */
    public function setClientId(int $clientId)
    {
        $this->clientId = $clientId;
    }
}
