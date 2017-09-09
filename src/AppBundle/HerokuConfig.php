<?php

namespace AppBundle;

use Composer\Script\Event;

class HerokuConfig
{
    /**
     * @param Event $event
     */
    public static function populateEnvironment(Event $event)
    {
        self::populateDatabaseEnvironment($event);
        self::populateAmqpEnvironment($event);
    }

    /**
     * @param Event $event
     */
    private static function populateDatabaseEnvironment(Event $event)
    {
        $url = getenv('DATABASE_URL');

        if ($url) {
            $config = parse_url($url);

            putenv(sprintf('DATABASE_HOST=%s', $config['host']));
            putenv(sprintf('DATABASE_PORT=%s', $config['port']));
            putenv(sprintf('DATABASE_USER=%s', $config['user']));
            putenv(sprintf('DATABASE_PASSWORD=%s', $config['pass']));
            putenv(sprintf('DATABASE_NAME=%s', ltrim('/', $config['path'])));
        }

        $io = $event->getIO();
        $io->write(sprintf('DATABASE_URL=%s', $url));
    }

    /**
     * @param Event $event
     */
    private static function populateAmqpEnvironment(Event $event)
    {
        $url = getenv('AMQP_URL');

        if ($url) {
            $config = parse_url($url);

            putenv(sprintf('AMQP_HOST=%s', $config['host']));
            putenv(sprintf('AMQP_PORT=%s', $config['port']));
            putenv(sprintf('AMQP_USER=%s', $config['user']));
            putenv(sprintf('AMQP_PASSWORD=%s', $config['pass']));
            putenv(sprintf('AMQP_VHOST=%s', ltrim('/', $config['path'])));
        }

        $io = $event->getIO();
        $io->write(sprintf('AMQP_URL=%s', $url));
    }
}
