<?php

namespace Tests\AppBundle\Serializer\Normalizer;

use AppBundle\Serializer\Normalizer\EventNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class EventNormalizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EventNormalizer
     */
    private $eventNormalizer;

    protected function setUp()
    {
        parent::setUp();

        $this->eventNormalizer = new EventNormalizer();
    }

    protected function tearDown()
    {
        parent::tearDown();

        unset($this->eventNormalizer);
    }

    public function test_setSerializer_InvalidArgumentException()
    {
        $this->expectException(\Symfony\Component\Serializer\Exception\InvalidArgumentException::class);
        $this->expectExceptionMessage('Expected a serializer that also implements DenormalizerInterface.');

        $serializer = $this->getMockBuilder(SerializerInterface::class)
            ->getMock();

        $this->eventNormalizer->setSerializer($serializer);
    }
}
