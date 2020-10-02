/*
SQLyog Ultimate v11.33 (32 bit)
MySQL - 10.4.13-MariaDB : Database - extreme
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`extreme` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

/*Table structure for table `pqr` */

DROP TABLE IF EXISTS `pqr`;

CREATE TABLE `pqr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `tipo_pqr` enum('Petición','Queja','Reclamo') DEFAULT NULL,
  `asunto_pqr` text DEFAULT NULL,
  `estado` enum('Nuevo','En ejecución','Cerrado','Vencida') DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_limite` datetime DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pqr` */

insert  into `pqr`(`id`,`id_usuario`,`tipo_pqr`,`asunto_pqr`,`estado`,`fecha_creacion`,`fecha_limite`,`updated_at`) values (1,2,'Queja','queja por ...','Vencida','2020-09-28 02:48:48','2020-10-01 02:48:48',NULL),(2,2,'Reclamo','reclamo por ..','Nuevo','2020-10-02 02:52:38','2020-10-04 02:52:38',NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` double DEFAULT NULL,
  `rol` enum('Administrador','Usuario') DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `commentary` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`firstname`,`lastname`,`email`,`phone`,`rol`,`user`,`password`,`commentary`,`created_at`,`updated_at`) values (1,'administrador','admin','jlverbel09@gmail.com',3225454,'Administrador','admin','7c4a8d09ca3762af61e59520943dc26494f8941b','hola mundo','2020-10-02 02:35:07','2020-10-02 02:35:14'),(2,'saray ','verbel diaz','saray@gmail.com',3227878,'Usuario','saray','e376a720a3812f5ad94278282924246bb63d126c','hola mundo',NULL,'2020-10-02 07:28:27'),(3,'gloria','gomez gonzales','gloria@gmail.com',3225454,'Usuario','gloria','a7a2f714daa2444d8bbee207554302ff38d2e478','hola mundo',NULL,NULL),(4,'carlos','toledo ojeda','carlos@gmail.com',3224545,'Usuario','carlos','ab5e2bca84933118bbc9d48ffaccce3bac4eeb64','hola mundo',NULL,NULL),(5,'david','sanchez perea','david@gmail.com',3224545,'Usuario','david','aa743a0aaec8f7d7a1f01442503957f4d7a2d634','hola mundo',NULL,NULL),(6,'manuel','castañeda osorio','manuel@gmail.com',3227878,'Usuario','manuel','adc16fa41a38b174232f206e0b2bd006baaace68','hola mundo',NULL,NULL),(7,'daniel','castro duarte','daniel@gmail.com',3215454,'Usuario','daniel','3d0f3b9ddcacec30c4008c5e030e6c13a478cb4f','hola mundo',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
