

DROP TABLE IF EXISTS `acessmanager`.`groups`;
DROP TABLE IF EXISTS `acessmanager`.`groups_rules`;
DROP TABLE IF EXISTS `acessmanager`.`groups_users`;
DROP TABLE IF EXISTS `acessmanager`.`rules`;
DROP TABLE IF EXISTS `acessmanager`.`users`;


CREATE TABLE `acessmanager`.`groups` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`created` datetime NOT NULL,
	`modified` datetime NOT NULL,
	`status` tinyint(1) DEFAULT '1' NOT NULL,	PRIMARY KEY  (`id`),
	UNIQUE KEY `name_UNIQUE` (`name`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `acessmanager`.`groups_rules` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`group_id` int(11) NOT NULL,
	`rule_id` int(11) NOT NULL,	PRIMARY KEY  (`id`),
	UNIQUE KEY `fk_group_rule_unique` (`group_id`, `rule_id`),
	KEY `fk_group_id` (`group_id`),
	KEY `fk_rule_id` (`rule_id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `acessmanager`.`groups_users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`group_id` int(11) NOT NULL,
	`user_id` int(11) NOT NULL,	PRIMARY KEY  (`id`),
	UNIQUE KEY `fk_group_user_unique` (`group_id`, `user_id`),
	KEY `fk_group_id` (`group_id`),
	KEY `fk_user_id` (`user_id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `acessmanager`.`rules` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`plugin` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`controller` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`action` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`admin` tinyint(1) DEFAULT NULL,
	`params_pass` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`alow` tinyint(1) NOT NULL,
	`order` int(10) NOT NULL,	PRIMARY KEY  (`id`),
	UNIQUE KEY `name_UNIQUE` (`name`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `acessmanager`.`users` (
	`id` int(10) NOT NULL AUTO_INCREMENT,
	`username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`password` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`passwordchangecode` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`created` datetime NOT NULL,
	`modified` datetime NOT NULL,
	`email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,	PRIMARY KEY  (`id`),
	UNIQUE KEY `username_UNIQUE` (`username`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

