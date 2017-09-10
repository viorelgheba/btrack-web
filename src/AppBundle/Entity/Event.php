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
     * @return \DateTime
     */
    public function getEventDatetime()
    {
        return $this->eventDatetime;
    }

    /**
     * @param \DateTime $eventDatetime
     */
    public function setEventDatetime($eventDatetime)
    {
        $this->eventDatetime = $eventDatetime;
    }

    /**
     * @return float
     */
    public function getPositionOx(): float
    {
        return $this->positionOx;
    }

    /**
     * @param float $positionOx
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
    public function getPositionOy(): float
    {
        return $this->positionOy;
    }

    /**
     * @param float $positionOy
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
     */
    public function setCreated($created)
    {
        $this->created = $created;
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
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
    }

    /**
     * @return boolean
     */
    public function isStatus()
    {
        return $this->status;
    }

    /**
     * @param boolean $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getShowroom()
    {
        return $this->showroom;
    }

    /**
     * @param Showroom $showroom
     *
     * @return $this
     */
    public function setShowroom(Showroom $showroom)
    {
        $this->showroom = $showroom;

        return $this;
    }
}

