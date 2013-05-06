-- MySQL dump 10.13  Distrib 5.5.31, for debian-linux-gnu (i686)
--
-- Host: 127.0.0.1    Database: scms
-- ------------------------------------------------------
-- Server version	5.5.31-0ubuntu0.12.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `am_actions`
--

DROP TABLE IF EXISTS `am_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_id` int(11) NOT NULL,
  `alias` varchar(45) NOT NULL,
  `alow` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_actions_rules1` (`rule_id`),
  CONSTRAINT `fk_actions_rules1` FOREIGN KEY (`rule_id`) REFERENCES `am_rules` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_actions`
--

LOCK TABLES `am_actions` WRITE;
/*!40000 ALTER TABLE `am_actions` DISABLE KEYS */;
/*!40000 ALTER TABLE `am_actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_entitys_users`
--

DROP TABLE IF EXISTS `am_entitys_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_entitys_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entity` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_entitys_users`
--

LOCK TABLES `am_entitys_users` WRITE;
/*!40000 ALTER TABLE `am_entitys_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `am_entitys_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_groups`
--

DROP TABLE IF EXISTS `am_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_groups`
--

LOCK TABLES `am_groups` WRITE;
/*!40000 ALTER TABLE `am_groups` DISABLE KEYS */;
INSERT INTO `am_groups` VALUES (1,'MASTER','2013-05-01 02:41:56','2013-05-01 02:41:56',1);
/*!40000 ALTER TABLE `am_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_groups_rules`
--

DROP TABLE IF EXISTS `am_groups_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_groups_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `rule_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fk_group_rule_unique` (`group_id`,`rule_id`),
  KEY `fk_group_id` (`group_id`),
  KEY `fk_rule_id` (`rule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_groups_rules`
--

LOCK TABLES `am_groups_rules` WRITE;
/*!40000 ALTER TABLE `am_groups_rules` DISABLE KEYS */;
/*!40000 ALTER TABLE `am_groups_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_groups_users`
--

DROP TABLE IF EXISTS `am_groups_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_groups_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fk_group_user_unique` (`group_id`,`user_id`),
  KEY `fk_group_id` (`group_id`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_groups_users`
--

LOCK TABLES `am_groups_users` WRITE;
/*!40000 ALTER TABLE `am_groups_users` DISABLE KEYS */;
INSERT INTO `am_groups_users` VALUES (10,1,1);
/*!40000 ALTER TABLE `am_groups_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_rules`
--

DROP TABLE IF EXISTS `am_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `plugin` varchar(45) DEFAULT NULL,
  `controller` varchar(45) DEFAULT NULL,
  `action` varchar(45) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `params_pass` varchar(255) DEFAULT NULL,
  `alow` tinyint(1) NOT NULL,
  `order` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_rules`
--

LOCK TABLES `am_rules` WRITE;
/*!40000 ALTER TABLE `am_rules` DISABLE KEYS */;
/*!40000 ALTER TABLE `am_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_users`
--

DROP TABLE IF EXISTS `am_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `passwordchangecode` varchar(128) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_users`
--

LOCK TABLES `am_users` WRITE;
/*!40000 ALTER TABLE `am_users` DISABLE KEYS */;
INSERT INTO `am_users` VALUES (1,'master','f9a8230ec347558101ef32b5ccec63b3','','2013-05-01 02:42:19','2013-05-01 03:10:18','jacksonbicalho@gmail.com',1);
/*!40000 ALTER TABLE `am_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'scms'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-05-06  0:37:17
