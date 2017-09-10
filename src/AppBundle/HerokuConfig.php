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
        $io = $event->getIO();

        $url = getenv('DATABASE_URL');
        if (!$url) {
            $io->write('DATABASE_URL env variable not found');
            return;
        }

        $io->write(sprintf('DATABASE_URL=%s', $url));

        $config = parse_url($url);

        putenv(sprintf('DATABASE_HOST=%s', $config['host']));
        $io->write(sprintf('DATABASE_HOST=%s', $config['host']));

        putenv(sprintf('DATABASE_PORT=%d', isset($config['port']) ? $config['port'] : 3306));
        $io->write(sprintf('DATABASE_PORT=%d', isset($config['port']) ? $config['port'] : 3306));

        putenv(sprintf('DATABASE_USER=%s', $config['user']));
        $io->write(sprintf('DATABASE_USER=%s', $config['user']));

        putenv(sprintf('DATABASE_PASSWORD=%s', $config['pass']));
        $io->write(sprintf('DATABASE_PASSWORD=%s', $config['pass']));

        putenv(sprintf('DATABASE_NAME=%s', substr($config['path'], 1) ?: '/'));
        $io->write(sprintf('DATABASE_NAME=%s', substr($config['path'], 1) ?: '/'));
    }

    /**
     * @param Event $event
     */
    private static function populateAmqpEnvironment(Event $event)
    {
        $io = $event->getIO();

        $url = getenv('AMQP_URL');
        if (!$url) {
            $io->write('AMQP_URL env variable not found');
            return;
        }

        $io->write(sprintf('AMQP_URL=%s', $url));

        $config = parse_url($url);

        putenv(sprintf('AMQP_HOST=%s', $config['host']));
        $io->write(sprintf('AMQP_HOST=%s', $config['host']));

        putenv(sprintf('AMQP_PORT=%d', isset($config['port']) ? $config['port'] : 5672));
        $io->write(sprintf('AMQP_PORT=%d', isset($config['port']) ? $config['port'] : 5672));

        putenv(sprintf('AMQP_USER=%s', $config['user']));
        $io->write(sprintf('AMQP_USER=%s', $config['user']));

        putenv(sprintf('AMQP_PASSWORD=%s', $config['pass']));
        $io->write(sprintf('AMQP_PASSWORD=%s', $config['pass']));

        putenv(sprintf('AMQP_VHOST=%s', substr($config['path'], 1) ?: '/'));
        $io->write(sprintf('AMQP_VHOST=%s', substr($config['path'], 1) ?: '/'));
    }
}
