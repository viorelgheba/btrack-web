<?php

namespace AppBundle\DependencyInjection\Compiler;

use AppBundle\Service\RabbitMqPublisher;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class RabbitMqProducerCompilerPass
 *
 * @package AppBundle\DependencyInjection\Compiler
 * @codeCoverageIgnore
 */
class RabbitMqProducerCompilerPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $contextDefinition = $container->findDefinition(RabbitMqPublisher::ID);

        $producerIds = $container->findTaggedServiceIds('old_sound_rabbit_mq.producer');

        foreach (array_keys($producerIds) as $producerId) {
            $contextDefinition->addMethodCall(
                'addProducer',
                array($producerId, new Reference($producerId))
            );
        }
    }
}
