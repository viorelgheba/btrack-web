<?php

namespace AppBundle\EventListener;

use Monolog\Logger;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Logger\ConsoleLogger;

class ConsoleLoggerListener
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @param ConsoleCommandEvent $event
     */
    public function onCommand(ConsoleCommandEvent $event)
    {
        /**
         * force monolog to log in stdout and stderr
         */
        $this->logger->setHandlers(
            array(
                new ConsoleLogger($event->getOutput(), Logger::DEBUG),
            )
        );
    }

    /**
     * @param Logger $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }
}
