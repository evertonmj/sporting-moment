# ************************************************************
# Sequel Pro SQL dump
# Vers„o 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.38)
# Base de Dados: momento_esportivo
# Tempo de GeraÁ„o: 2016-05-14 14:37:08 +0000
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;

INSERT INTO `event` (`id`, `name`, `description`, `datetime`, `localization`, `latitude_coordinate`, `longitude_coordinate`, `updated_at`, `created_at`)
VALUES
	(11,'Palmeiras e Corinthians','Grande Jogo!','2016-05-02 22:30:00','Palestra Italia!','-23.5275868','-46.6806575','2016-05-03 20:32:02','2016-04-26 16:28:01'),
	(12,'Bahia e Vitoria','Grande cl√°ssico baiano','2016-05-01 16:00:00','Fonte Nova','-12.97883','-38.5065598','2016-05-03 20:32:52','2016-04-26 16:28:37'),
	(18,'Flamengo e Vasco','Flamengo e Vasco','2016-03-16 20:00:00','Maracan√£','-22.9121089','-43.2323445','2016-05-03 20:34:19','2016-05-03 20:34:19');

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
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

LOCK TABLES `moment` WRITE;
/*!40000 ALTER TABLE `moment` DISABLE KEYS */;

INSERT INTO `moment` (`id`, `event_id`, `description`, `time`, `url`, `type`, `updated_at`, `created_at`)
VALUES
	(2,12,'Gollll do vitoria','20:41:00','lslkasdjlasdkjlsdkjaslk','V','2016-05-03 18:11:39','2016-05-03 17:53:13'),
	(3,12,'Gol do vitoria','20:50:00','kaksaasklsalk','V','2016-05-03 18:11:39','2016-05-03 18:11:39');

/*!40000 ALTER TABLE `moment` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela team
# ------------------------------------------------------------

DROP TABLE IF EXISTS `team`;

CREATE TABLE `team` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;

INSERT INTO `team` (`id`, `name`, `description`, `updated_at`, `created_at`)
VALUES
	(2,'Vitoria','Vitoriasses','2016-05-03 00:27:51','2016-05-03 00:26:50'),
	(3,'Palmeiras','Verd√£o','2016-05-03 00:27:39','2016-05-03 00:27:03'),
	(4,'Bahia','Bahia e Vitoria','2016-05-03 00:28:01','2016-05-03 00:28:01'),
	(5,'Corinthians','Corinthians SC','2016-05-03 18:57:46','2016-05-03 18:57:46'),
	(6,'Flamengo','Flamengo','2016-05-03 20:33:07','2016-05-03 20:33:07'),
	(7,'Vasco','Vasco','2016-05-03 20:33:12','2016-05-03 20:33:12');

/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela team_event
# ------------------------------------------------------------

DROP TABLE IF EXISTS `team_event`;

CREATE TABLE `team_event` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` int(11) unsigned NOT NULL,
  `event_id` int(11) unsigned NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `team_id` (`team_id`),
  KEY `event_id` (`event_id`),
  CONSTRAINT `team_event_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `team_event_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

LOCK TABLES `team_event` WRITE;
/*!40000 ALTER TABLE `team_event` DISABLE KEYS */;

INSERT INTO `team_event` (`id`, `team_id`, `event_id`, `updated_at`, `created_at`)
VALUES
	(3,6,12,'2016-05-03 20:34:19','2016-05-03 20:34:19'),
	(4,7,12,'2016-05-03 20:34:19','2016-05-03 20:34:19');

/*!40000 ALTER TABLE `team_event` ENABLE KEYS */;
UNLOCK TABLES;


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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `name`, `email`)
VALUES
	(1,'Everton','evertonmj@gmail.com'),
	(2,'Artur','arturhayne@gmail.com');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela user_event
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_event`;

CREATE TABLE `user_event` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `event_id` int(11) unsigned NOT NULL,
  `is_on_chair` int(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `event_id` (`event_id`),
  CONSTRAINT `user_event_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_event_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

LOCK TABLES `user_event` WRITE;
/*!40000 ALTER TABLE `user_event` DISABLE KEYS */;

INSERT INTO `user_event` (`id`, `user_id`, `event_id`, `is_on_chair`, `created_at`, `updated_at`)
VALUES
	(1,1,12,0,'2016-05-03 22:53:37','2016-05-03 22:53:37'),
	(2,1,12,0,'2016-05-03 22:54:02','2016-05-03 22:54:02'),
	(3,1,12,0,'2016-05-03 22:54:26','2016-05-03 22:54:26'),
	(4,2,12,1,'2016-05-03 22:55:02','2016-05-03 23:05:54');

/*!40000 ALTER TABLE `user_event` ENABLE KEYS */;
UNLOCK TABLES;


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
