<?php

namespace AppBundle\Serializer\Normalizer;

use AppBundle\Dto\BeaconDto;
use Symfony\Component\Serializer\Exception\BadMethodCallException;
use Symfony\Component\Serializer\Exception\ExtraAttributesException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Exception\RuntimeException;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class BeaconNormalizer implements DenormalizerInterface
{
    /**
     * Denormalizes data back into an object of the given class.
     *
     * @param mixed  $data    data to restore
     * @param string $class   the expected class to instantiate
     * @param string $format  format the given data was extracted from
     * @param array  $context options available to the denormalizer
     *
     * @return object
     *
     * @throws BadMethodCallException   Occurs when the normalizer is not called in an expected context
     * @throws InvalidArgumentException Occurs when the arguments are not coherent or not supported
     * @throws UnexpectedValueException Occurs when the item cannot be hydrated with the given data
     * @throws ExtraAttributesException Occurs when the item doesn't have attribute to receive given data
     * @throws LogicException           Occurs when the normalizer is not supposed to denormalize
     * @throws RuntimeException         Occurs if the class cannot be instantiated
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (!array_key_exists('name', $data)) {
            throw new InvalidArgumentException('Missing beacon name key.');
        }

        if (!array_key_exists('uuid', $data)) {
            throw new InvalidArgumentException('Missing beacon uuid key.');
        }

        if (!array_key_exists('signal_strength', $data)) {
            throw new InvalidArgumentException('Missing beacon signal_strength key.');
        }

        if (!array_key_exists('distance', $data)) {
            throw new InvalidArgumentException('Missing beacon distance key.');
        }

        if (!array_key_exists('zone', $data)) {
            throw new InvalidArgumentException('Missing beacon zone key.');
        }

        $object = new BeaconDto();

        $object->setName($data['name'])
            ->setUuid($data['uuid'])
            ->setSignalStrength((float)$data['signal_strength'])
            ->setDistance((float)$data['distance'])
            ->setZone($data['zone']);

        return $object;
    }

    /**
     * Checks whether the given class is supported for denormalization by this normalizer.
     *
     * @param mixed  $data   Data to denormalize from
     * @param string $type   The class to which the data should be denormalized
     * @param string $format The format being deserialized from
     *
     * @return bool
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === BeaconDto::class;
    }
}
