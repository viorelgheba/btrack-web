<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="")
 */
class Event
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Showroom
     *
     * @ManyToOne(targetEntity="Showroom")
     * @JoinColumn(name="showroom_id", referencedColumnName="id")
     */
    private $showroom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="event_datetime", type="datetime", nullable=false)
     */
    private $eventDatetime;

    /**
     * @var float
     *
     * @ORM\Column(name="position_Ox", type="float", nullable=false)
     */
    private $positionOx;

    /**
     * @var float
     *
     * @ORM\Column(name="position_Oy", type="float", nullable=false)
     */
    private $positionOy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime", nullable=false)
     */
    private $modified = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status = self::STATUS_ACTIVE;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Showroom
     */
    public function getShowroom()
    {
        return $this->showroom;
    }

    /**
     * @param Showroom $showroom
     *
     * @return Event
     */
    public function setShowroom(Showroom $showroom): Event
    {
        $this->showroom = $showroom;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEventDatetime()
    {
        return $this->eventDatetime;
    }

    /**
     * @param \DateTime $eventDatetime
     *
     * @return Event
     */
    public function setEventDatetime(\DateTime $eventDatetime): Event
    {
        $this->eventDatetime = $eventDatetime;

        return $this;
    }

    /**
     * @return float
     */
    public function getPositionOx()
    {
        return $this->positionOx;
    }

    /**
     * @param float $positionOx
     *
     * @return Event
     */
    public function setPositionOx(float $positionOx): Event
    {
        $this->positionOx = $positionOx;

        return $this;
    }

    /**
     * @return float
     */
    public function getPositionOy()
    {
        return $this->positionOy;
    }

    /**
     * @param float $positionOy
     *
     * @return Event
     */
    public function setPositionOy(float $positionOy): Event
    {
        $this->positionOy = $positionOy;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     *
     * @return Event
     */
    public function setCreated(\DateTime $created): Event
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param \DateTime $modified
     *
     * @return Event
     */
    public function setModified(\DateTime $modified): Event
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return Event
     */
    public function setStatus(int $status): Event
    {
        $this->status = $status;

        return $this;
    }
}

