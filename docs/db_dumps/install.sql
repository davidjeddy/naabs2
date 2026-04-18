CREATE TABLE `radius`.`user` (
  `uuid` INT(11) NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(32) NOT NULL,
  `lname` VARCHAR(32) NOT NULL,
  `address_1` VARCHAR(64) NOT NULL,
  `address_2` VARCHAR(64) NULL,
  `address_3` VARCHAR(2) NOT NULL,
  `postal_code` VARCHAR(16) NOT NULL,
  `country` INT(2) NULL,
  `phone_1` INT(10) NOT NULL,
  `phone_2` INT(10) NULL,
  `lot` VARCHAR(5) NULL,
  `username` VARCHAR(32) NOT NULL,
  `password` VARCHAR(32) NOT NULL,
  `question` VARCHAR(256) NOT NULL,
  `answer` VARCHAR(64) NOT NULL,
  `create` TIMESTAMP NOT NULL DEFAULT '2014-01-01 00:00:01',,
  `update` TIMESTAMP NULL,
  `delete` TIMESTAMP NULL,
  PRIMARY KEY (`uuid`),
  UNIQUE INDEX `uuid_UNIQUE` (`uuid` ASC));


CREATE TABLE `radius`.`access_plans` (
  `id` INT(1) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(32) NOT NULL,
  `amount` DECIMAL(3,2) NOT NULL,
  `value` INT(11) NOT NULL DEFAULT 0,
  `create` TIMESTAMP NOT NULL DEFAULT '2014-01-01 00:00:01',
  `update` TIMESTAMP NULL,
  `delete` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));

CREATE TABLE `radius`.`months` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(16) NOT NULL,
  `value` INT(2) NOT NULL,
  `create` TIMESTAMP NOT NULL DEFAULT '2014-01-01 00:00:01',
  `update` TIMESTAMP NULL,
  `delete` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));

CREATE TABLE `radius`.`new_table` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(64) NOT NULL,
  `value` INT(4) NOT NULL,
  `create` TIMESTAMP NOT NULL DEFAULT '2014-01-01 00:00:01',
  `update` TIMESTAMP NULL,
  `delete` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));
