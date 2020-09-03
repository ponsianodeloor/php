/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.11-MariaDB : Database - biblioteca_publica
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`biblioteca_publica` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `biblioteca_publica`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `AdminDNI` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `AdminNombre` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `AdminApellido` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `AdminTelefono` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `AdminDireccion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaCodigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `CuentaCodigo` (`CuentaCodigo`),
  CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`CuentaCodigo`) REFERENCES `cuenta` (`CuentaCodigo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `admin` */

insert  into `admin`(`id`,`AdminDNI`,`AdminNombre`,`AdminApellido`,`AdminTelefono`,`AdminDireccion`,`CuentaCodigo`) values 
(1,'1206413435','Ponsiano','De Loor','0968894134','Urdaneta','ABCD1234'),
(8,'1717822116','Mireya','Levy','0995603731','Alangasi, Galaxias y Marte','AC4610344'),
(9,'1208893673','Enrique','Bumburys','09882738','Urdaneta','AC3970811');

/*Table structure for table `bitacora` */

DROP TABLE IF EXISTS `bitacora`;

CREATE TABLE `bitacora` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `BitacoraCodigo` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `BitacoraFecha` date NOT NULL,
  `BitacoraHoraInicio` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `BitacoraHoraFinal` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `BitacoraTipo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `BitacoraYear` int(4) NOT NULL,
  `CuentaCodigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `CuentaCodigo` (`CuentaCodigo`),
  CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`CuentaCodigo`) REFERENCES `cuenta` (`CuentaCodigo`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `bitacora` */

insert  into `bitacora`(`id`,`BitacoraCodigo`,`BitacoraFecha`,`BitacoraHoraInicio`,`BitacoraHoraFinal`,`BitacoraTipo`,`BitacoraYear`,`CuentaCodigo`) values 
(1,'CB9150444','2020-06-03','05:25:55','Sin registro','Administrador',2020,'ABCD1234'),
(2,'CB2624099','2020-06-03','06:00:12','Sin registro','Administrador',2020,'ABCD1234'),
(3,'CB0376033','2020-06-03','06:01:27','Sin registro','Administrador',2020,'ABCD1234'),
(4,'CB7796299','2020-06-03','06:07:30','Sin registro','Administrador',2020,'ABCD1234'),
(5,'CB1312499','2020-06-03','06:08:26','Sin registro','Administrador',2020,'ABCD1234'),
(6,'CB4472811','2020-06-03','06:08:49','Sin registro','Administrador',2020,'ABCD1234'),
(7,'CB1921399','2020-06-04','08:03:21','08:37:38','Administrador',2020,'ABCD1234'),
(8,'CB4805311','2020-06-04','06:29:45','07:17:12','Administrador',2020,'ABCD1234'),
(9,'CB5567777','2020-06-04','07:17:17','Sin registro','Administrador',2020,'AC4610344'),
(10,'CB3615588','2020-06-04','07:28:58','Sin registro','Administrador',2020,'ABCD1234'),
(11,'CB6171833','2020-06-05','12:50:31','01:38:40','Administrador',2020,'ABCD1234'),
(12,'CB9789877','2020-06-05','01:38:52','Sin registro','Administrador',2020,'ABCD1234'),
(13,'CB8445900','2020-06-05','06:09:34','06:15:56','Administrador',2020,'ABCD1234'),
(14,'CB5951122','2020-06-05','06:16:00','Sin registro','Administrador',2020,'ABCD1234'),
(15,'CB0676911','2020-06-05','10:25:19','10:29:10','Administrador',2020,'ABCD1234'),
(16,'CB4082033','2020-06-05','10:29:15','Sin registro','Administrador',2020,'ABCD1234'),
(17,'CB4032166','2020-06-06','11:33:50','Sin registro','Administrador',2020,'ABCD1234'),
(18,'CB6891777','2020-09-03','10:39:46','10:44:15','Administrador',2020,'ABCD1234');

/*Table structure for table `categoria` */

DROP TABLE IF EXISTS `categoria`;

CREATE TABLE `categoria` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `CategoriaCodigo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `CategoriaNombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `CategoriaCodigo` (`CategoriaCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `categoria` */

/*Table structure for table `cliente` */

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ClienteDNI` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `ClienteNombre` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `ClienteApellido` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `ClienteTelefono` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `ClienteOcupacion` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `ClienteDireccion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaCodigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `CuentaCodigo` (`CuentaCodigo`),
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`CuentaCodigo`) REFERENCES `cuenta` (`CuentaCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `cliente` */

/*Table structure for table `cuenta` */

DROP TABLE IF EXISTS `cuenta`;

CREATE TABLE `cuenta` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `CuentaCodigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaPrivilegio` int(1) NOT NULL,
  `CuentaUsuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaClave` varchar(535) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaEmail` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaEstado` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaTipo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaGenero` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaFoto` varchar(535) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `CuentaCodigo` (`CuentaCodigo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `cuenta` */

insert  into `cuenta`(`id`,`CuentaCodigo`,`CuentaPrivilegio`,`CuentaUsuario`,`CuentaClave`,`CuentaEmail`,`CuentaEstado`,`CuentaTipo`,`CuentaGenero`,`CuentaFoto`) values 
(1,'ABCD1234',1,'ponsiano','dXZWcWIzeUdvWmFWYTgvcVh3STZDQT09','ponsianodeloor@gmail.com','Activo','Administrador','Masculino','Male3Avatar.png'),
(7,'AC4610344',2,'mireyalevy','bkxid0ZVa2VTZHpJN2dhanNzaUc4Zz09','levyortizmireya@gmail.com','Activo','Administrador','Femenino','Female3Avatar.png'),
(8,'AC3970811',2,'enriquebumbury','dTBndUhwb1FpbjI2cGpUSFBJU2RZQT09','e@gmail.com','Activo','Administrador','Masculino','Male3Avatar.png');

/*Table structure for table `empresa` */

DROP TABLE IF EXISTS `empresa`;

CREATE TABLE `empresa` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `EmpresaCodigo` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `EmpresaNombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `EmpresaTelefono` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `EmpresaEmail` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `EmpresaDireccion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `EmpresaDirector` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `EmpresaMoneda` varchar(1) COLLATE utf8_spanish2_ci NOT NULL,
  `EmpresaYear` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `EmpresaCodigo` (`EmpresaCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `empresa` */

/*Table structure for table `libro` */

DROP TABLE IF EXISTS `libro`;

CREATE TABLE `libro` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `LibroCodigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `LibroTitulo` varchar(170) COLLATE utf8_spanish2_ci NOT NULL,
  `LibroAutor` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `LibroPais` int(50) NOT NULL,
  `LibroYear` int(4) NOT NULL,
  `LibroEditorial` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `LibroEdicion` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `LibroPrecio` decimal(30,2) NOT NULL,
  `LibroStock` int(5) NOT NULL,
  `LibroUbicacion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `LibroResumen` text COLLATE utf8_spanish2_ci NOT NULL,
  `LibroImagen` varchar(535) COLLATE utf8_spanish2_ci NOT NULL,
  `LibroPDF` varchar(535) COLLATE utf8_spanish2_ci NOT NULL,
  `LibroDescarga` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `CategoriaCodigo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `ProveedorCodigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `EmpresaCodigo` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `LibroCodigo` (`LibroCodigo`),
  KEY `CategoriaCodigo` (`CategoriaCodigo`),
  KEY `ProveedorCodigo` (`ProveedorCodigo`),
  KEY `EmpresaCodigo` (`EmpresaCodigo`),
  CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`CategoriaCodigo`) REFERENCES `categoria` (`CategoriaCodigo`),
  CONSTRAINT `libro_ibfk_2` FOREIGN KEY (`ProveedorCodigo`) REFERENCES `proveedor` (`ProveedorCodigo`),
  CONSTRAINT `libro_ibfk_3` FOREIGN KEY (`EmpresaCodigo`) REFERENCES `empresa` (`EmpresaCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `libro` */

/*Table structure for table `proveedor` */

DROP TABLE IF EXISTS `proveedor`;

CREATE TABLE `proveedor` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ProveedorCodigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `ProveedorNombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `ProveedorResponsable` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `ProveedorTelefono` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `ProveedorEmail` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `ProveedorDireccion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ProveedorCodigo` (`ProveedorCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `proveedor` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
