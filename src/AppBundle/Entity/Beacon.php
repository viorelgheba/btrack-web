<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Beacon
 *
 * @ORM\Table(name="beacon", indexes={@ORM\Index(name="idx_uuid", columns={"uuid"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BeaconRepository")
 */
class Beacon
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", length=17, nullable=false)
     */
    private $uuid;

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
     * @var Showroom
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Showroom", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="showroom", referencedColumnName="id")
     */
    private $showroom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime", nullable=true)
     */
    private $modified;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status = self::STATUS_ACTIVE;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return Beacon
     */
    public function setUuid(string $uuid): Beacon
    {
        $this->uuid = $uuid;

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
     * @return Beacon
     */
    public function setPositionOx(float $positionOx): Beacon
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
     * @return Beacon
     */
    public function setPositionOy(float $positionOy): Beacon
    {
        $this->positionOy = $positionOy;

        return $this;
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
     * @return Beacon
     */
    public function setShowroom(Showroom $showroom): Beacon
    {
        $this->showroom = $showroom;

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
     * @return Beacon
     */
    public function setCreated(\DateTime $created): Beacon
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
     * @return Beacon
     */
    public function setModified(\DateTime $modified): Beacon
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
     * @return Beacon
     */
    public function setStatus(int $status): Beacon
    {
        $this->status = $status;

        return $this;
    }
}

