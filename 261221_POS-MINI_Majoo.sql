/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.3.32-MariaDB-cll-lve : Database - nestivent_majoo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`nestivent_majoo` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `nestivent_majoo`;

/*Table structure for table `tb_auth` */

DROP TABLE IF EXISTS `tb_auth`;

CREATE TABLE `tb_auth` (
  `kode_user` varchar(15) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` int(5) NOT NULL DEFAULT 1,
  PRIMARY KEY (`kode_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_auth` */

insert  into `tb_auth`(`kode_user`,`nama`,`username`,`password`,`role`) values 
('admn_01','ADMIN','admin','$2y$10$mqXI1muCWqeGA24r.dLsTOFOPl3wnCvudMmm02gNlltdeEsmKjYHW',0);

/*Table structure for table `tb_kategori` */

DROP TABLE IF EXISTS `tb_kategori`;

CREATE TABLE `tb_kategori` (
  `id_kategori` int(10) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(30) NOT NULL,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tb_kategori` */

insert  into `tb_kategori`(`id_kategori`,`kategori`,`keterangan`) values 
(2,'Hardware Kasirku','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(3,'Kasirku','');

/*Table structure for table `tb_produk` */

DROP TABLE IF EXISTS `tb_produk`;

CREATE TABLE `tb_produk` (
  `id_produk` int(10) NOT NULL AUTO_INCREMENT,
  `permalink` varchar(100) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `nama_produk` varchar(30) NOT NULL,
  `poster` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `harga` int(25) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_produk`),
  KEY `cons_produk-kategori` (`id_kategori`),
  CONSTRAINT `cons_produk-kategori` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `tb_produk` */

insert  into `tb_produk`(`id_produk`,`permalink`,`id_kategori`,`nama_produk`,`poster`,`keterangan`,`harga`,`tanggal`) values 
(23,'paket-advance',2,'Paket advance','poster_zvcf.png','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>\r\n',750000,'2021-12-26');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
