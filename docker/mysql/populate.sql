CREATE DATABASE IF NOT EXISTS dummy_db;

USE dummy_db;

DROP TABLE IF EXISTS `dummies`;
CREATE TABLE `dummies` (
    `id` varchar(36) NOT NULL,
    `name` varchar(36) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
