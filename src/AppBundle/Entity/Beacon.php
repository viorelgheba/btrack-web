<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Beacon
 *
 * @ORM\Table(name="beacon", indexes={@ORM\Index(name="idx_uuid", columns={"uuid"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BeaconRepository")
 */
class Beacon
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * @var Uuid
     *
     * @ORM\Column(name="uuid", type="uuid_binary", length=16, nullable=false)
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
     *
     * @ORM\ManyToOne(targetEntity="\Eis\AppBundle\Entity\Showroom", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="showroom", referencedColumnName="id")
     */
    private $showroom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime", nullable=true)
     */
    private $modified = 'CURRENT_TIMESTAMP';

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
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Uuid
     */
    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    /**
     * @param Uuid $uuid
     * @return Beacon
     */
    public function setUuid($uuid): Beacon
    {
        $this->uuid = $uuid;
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
    public function getPositionOy(): float
    {
        return $this->positionOy;
    }

    /**
     * @return Showroom
     */
    public function getShowroom(): Showroom
    {
        return $this->showroom;
    }

    /**
     * @param Showroom $showroom
     * @return Beacon
     */
    public function setShowroom(Showroom $showroom): Beacon
    {
        $this->showroom = $showroom;
        return $this;
    }

    /**
     * @param float $positionOy
     * @return Beacon
     */
    public function setPositionOy(float $positionOy): Beacon
    {
        $this->positionOy = $positionOy;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
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
    public function getModified(): \DateTime
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
    public function getStatus(): int
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

