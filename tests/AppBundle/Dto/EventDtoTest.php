<?php

namespace Tests\AppBundle\Dto;

use AppBundle\Dto\EventDto;

class EventDtoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EventDto
     */
    private $eventDto;

    protected function setUp()
    {
        parent::setUp();

        $this->eventDto = new EventDto();
    }

    protected function tearDown()
    {
        parent::tearDown();

        unset($this->eventDto);
    }

    public function testDto()
    {
        $now = new \DateTime('now');

        $this->eventDto->setTimestamp($now)
            ->setBeacons([]);

        $this->assertEquals($this->eventDto->getTimestamp(), $now);
        $this->assertEquals($this->eventDto->getBeacons(), []);
    }
}
