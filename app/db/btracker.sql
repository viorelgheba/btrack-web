CREATE DATABASE IF NOT EXISTS `btracker`;
USE `btracker`;

DROP TABLE IF EXISTS `beacon`;

CREATE TABLE `beacon` (
    `id`       INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `uuid`     BINARY(16)     NOT NULL,
    `created`  TIMESTAMP        NULL     DEFAULT CURRENT_TIMESTAMP,
    `modified` TIMESTAMP        NULL     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `status`   TINYINT(1)       NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`),
    KEY `idx_uuid` (`uuid`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
    `id`       INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
    `name`     VARCHAR(255)        NOT NULL DEFAULT '',
    `email`    VARCHAR(255)        NOT NULL DEFAULT '',
    `created`  TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `modified` TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `status`   TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `event`;

CREATE TABLE `event` (
    `id`             INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
    `customer_id`    INT(11) UNSIGNED    NOT NULL,
    `showroom_id`    INT(11) UNSIGNED    NOT NULL,
    `event_datetime` DATETIME            NOT NULL,
    `created`        TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `modified`       TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `status`         TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `showroom`;

CREATE TABLE `showroom` (
    `id`       INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`     VARCHAR(255)     NOT NULL DEFAULT '',
    `created`  TIMESTAMP        NULL     DEFAULT CURRENT_TIMESTAMP,
    `modified` TIMESTAMP        NULL     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `status`   TINYINT(1)       NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8;
