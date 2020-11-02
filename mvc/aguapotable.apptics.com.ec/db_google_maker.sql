/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.11-MariaDB : Database - db_google_marker
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_google_marker` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `db_google_marker`;

/*Table structure for table `locations` */

DROP TABLE IF EXISTS `locations`;

CREATE TABLE `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `address` varchar(80) DEFAULT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `type` varchar(30) DEFAULT NULL,
  `description` varchar(200) NOT NULL,
  `location_status` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `locations` */

insert  into `locations`(`id`,`name`,`address`,`lat`,`lng`,`type`,`description`,`location_status`) values (1,'Huerto Suyo','580 Darling Street, Rozelle, NSW',-0.288044,-78.447273,'restaurant','',0),(2,'Splash Kids','76 Wilford Street, Newtown, NSW',-0.286209,-78.449356,'bar','',0),(3,'Pacific Garden','Greenwood Plaza, 36 Blue St, North Sydney NSW',-0.286670,-78.449570,'bar','',0),(4,'Casa 1',NULL,-2.213358,-79.445938,NULL,'',0),(5,'Casa 2',NULL,-2.213388,-79.446037,NULL,'',0),(6,'Casa 3',NULL,-2.213412,-79.446136,NULL,'',0),(7,'Casa 4',NULL,-2.213448,-79.446236,NULL,'',0),(8,'Casa 5',NULL,-2.213768,-79.446182,NULL,'',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
