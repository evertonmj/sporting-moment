# ************************************************************
# Sequel Pro SQL dump
# Versão 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.38)
# Base de Dados: momento_esportivo
# Tempo de Geração: 2016-04-27 00:02:52 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump da tabela event
# ------------------------------------------------------------

DROP TABLE IF EXISTS `event`;

CREATE TABLE `event` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `localization` varchar(1000) DEFAULT NULL,
  `latitude_coordinate` varchar(100) DEFAULT NULL,
  `longitude_coordinate` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;

INSERT INTO `event` (`id`, `name`, `description`, `datetime`, `localization`, `latitude_coordinate`, `longitude_coordinate`, `updated_at`, `created_at`)
VALUES
	(3,'Bahia e Vitoria','BAVI','2016-04-15 16:00:00','Fonte Nova','00123123123','021312412312','2016-04-24 18:16:03','2016-04-24 18:16:03'),
	(4,'aaaa','aaa','2016-04-15 16:00:00','aaa','000','000','2016-04-24 18:35:12','2016-04-24 18:35:12'),
	(11,'Palmeiras e Corinthians','Grande Jogo!','2016-05-02 22:30:00','Palestra Italia!','000','000','2016-04-26 17:25:06','2016-04-26 16:28:01'),
	(12,'Bahia e Vitoria','Grande clÃ¡ssico baiano','2016-05-01 16:00:00','Fonte Nova','0000','0000','2016-04-26 17:25:23','2016-04-26 16:28:37');

/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela moment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `moment`;

CREATE TABLE `moment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `time` time DEFAULT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `type` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump da tabela team
# ------------------------------------------------------------

DROP TABLE IF EXISTS `team`;

CREATE TABLE `team` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump da tabela team_event
# ------------------------------------------------------------

DROP TABLE IF EXISTS `team_event`;

CREATE TABLE `team_event` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` int(11) unsigned NOT NULL,
  `event_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `team_id` (`team_id`),
  KEY `event_id` (`event_id`),
  CONSTRAINT `team_event_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `team_event_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump da tabela team_moment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `team_moment`;

CREATE TABLE `team_moment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` int(11) unsigned NOT NULL,
  `moment_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `team_id` (`team_id`),
  KEY `moment_id` (`moment_id`),
  CONSTRAINT `team_moment_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `team_moment_ibfk_2` FOREIGN KEY (`moment_id`) REFERENCES `moment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump da tabela user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `name`, `email`)
VALUES
	(1,'Everton','evertonmj@gmail.com');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela user_event
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_event`;

CREATE TABLE `user_event` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `event_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `event_id` (`event_id`),
  CONSTRAINT `user_event_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_event_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump da tabela user_team
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_team`;

CREATE TABLE `user_team` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `team_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `team_id` (`team_id`),
  CONSTRAINT `user_team_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_team_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
