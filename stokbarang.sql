/*
SQLyog Ultimate v12.5.1 (32 bit)
MySQL - 10.4.11-MariaDB : Database - stockbarang
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`stockbarang` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `stockbarang`;

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `idbarang` int(11) NOT NULL AUTO_INCREMENT,
  `namabarang` varchar(50) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`idbarang`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

/*Data for the table `barang` */

insert  into `barang`(`idbarang`,`namabarang`,`deskripsi`,`harga`,`jumlah`) values 
(12,'Kayu Jati','kayu jati kualitas tinggi',100000,162),
(13,'Batu Apung','Batu yang bisa mengapung',5000,195),
(14,'Pasir','Pasir penghisap surga',10000,42),
(15,'Besi','Besi anti karat',70000,177),
(16,'Betako','Betako kuat dan kokoh',3500,8950);

/*Table structure for table `keluar` */

DROP TABLE IF EXISTS `keluar`;

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL AUTO_INCREMENT,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `penerima` varchar(25) NOT NULL,
  `jumlahkeluar` int(11) NOT NULL,
  PRIMARY KEY (`idkeluar`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `keluar` */

insert  into `keluar`(`idkeluar`,`idbarang`,`tanggal`,`penerima`,`jumlahkeluar`) values 
(11,12,'2021-06-20 12:13:29','Boss Crazer',73),
(12,13,'2021-06-20 12:14:00','Perusahaan mengapung',700),
(13,14,'2021-06-20 12:15:14','Sang ilahi',12),
(14,15,'2021-06-20 12:15:43','Dr.Stone',45),
(15,16,'2021-06-20 12:16:26','Rakyat jelata',250);

/*Table structure for table `login` */

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `login` */

insert  into `login`(`iduser`,`username`,`password`) values 
(1,'Crazer','12345');

/*Table structure for table `masuk` */

DROP TABLE IF EXISTS `masuk`;

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL AUTO_INCREMENT,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(50) NOT NULL,
  `jumlahmasuk` int(11) NOT NULL,
  PRIMARY KEY (`idmasuk`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

/*Data for the table `masuk` */

insert  into `masuk`(`idmasuk`,`idbarang`,`tanggal`,`keterangan`,`jumlahmasuk`) values 
(24,12,'2021-06-20 12:10:13','Di kirim oleh crazer',35),
(25,13,'2021-06-20 12:10:43','Di tambang dari lereng gunung',545),
(26,14,'2021-06-20 12:11:24','Sangat susah dicari',4),
(27,15,'2021-06-20 12:11:51','Semoga saja tidak berkarat',47),
(28,16,'2021-06-20 12:12:35','Dibuat oleh tukang profesional',2700),
(29,17,'2021-06-20 20:31:33','Di kirim oleh crazer',10);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
