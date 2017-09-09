<?php

namespace Tests\AppBundle\Dto;

use AppBundle\Dto\BeaconDto;

class BeaconDtoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BeaconDto
     */
    private $beaconDto;

    protected function setUp()
    {
        parent::setUp();

        $this->beaconDto = new BeaconDto();
    }

    protected function tearDown()
    {
        parent::tearDown();

        unset($this->beaconDto);
    }

    public function testDto()
    {
        $this->beaconDto->setName('beacon_name')
            ->setUuid('beacon_uuid')
            ->setSignalStrength(0.98)
            ->setDistance(-1);

        $this->assertEquals($this->beaconDto->getName(), 'beacon_name');
        $this->assertEquals($this->beaconDto->getUuid(), 'beacon_uuid');
        $this->assertEquals($this->beaconDto->getSignalStrength(), 0.98);
        $this->assertEquals($this->beaconDto->getDistance(), -1);
    }
}
