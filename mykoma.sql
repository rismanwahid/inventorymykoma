/*
SQLyog Ultimate v8.4 
MySQL - 5.5.5-10.4.14-MariaDB : Database - mykoma
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `bahan_bk` */

DROP TABLE IF EXISTS `bahan_bk`;

CREATE TABLE `bahan_bk` (
  `kd_bahanbk` varchar(50) NOT NULL,
  `id_suplier` varchar(50) NOT NULL,
  `nm_bahanbk` varchar(100) NOT NULL,
  `tgl_expire` date NOT NULL,
  PRIMARY KEY (`kd_bahanbk`),
  KEY `FK_bahan_bk12` (`id_suplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bahan_bk` */

insert  into `bahan_bk`(`kd_bahanbk`,`id_suplier`,`nm_bahanbk`,`tgl_expire`) values ('BAHAN-0001','SUPLY-0002','Gulaku','2021-02-03'),('BAHAN-0002','SUPLY-0001','SKM','2021-01-01'),('BAHAN-0003','SUPLY-0003','Galon Aqua','2020-10-20'),('BAHAN-0004','SUPLY-0002','Gulaku','2021-01-01'),('BAHAN-0005','SUPLY-0001','SKM','2021-04-04'),('BAHAN-0006','SUPLY-0002','Bubuk Green Tea','2021-10-14'),('BAHAN-0007','SUPLY-0002','Bubuk Green Tea','2021-10-14');

/*Table structure for table `brg_keluar` */

DROP TABLE IF EXISTS `brg_keluar`;

CREATE TABLE `brg_keluar` (
  `kd_brgout` varchar(50) NOT NULL,
  `tgl_out` datetime NOT NULL,
  `id_pegawai` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_brgout`),
  KEY `FK_brg_keluar09` (`id_pegawai`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `brg_keluar` */

insert  into `brg_keluar`(`kd_brgout`,`tgl_out`,`id_pegawai`) values ('OUT-202010001','2020-10-13 23:53:04','PGW-0001'),('OUT-202010002','2020-10-14 19:52:06','PGW-0001'),('OUT-202010003','2020-10-14 19:53:26','PGW-0001'),('OUT-202010004','2020-10-14 19:54:15','PGW-0001');

/*Table structure for table `det_resep` */

DROP TABLE IF EXISTS `det_resep`;

CREATE TABLE `det_resep` (
  `kd_detresep` int(11) NOT NULL AUTO_INCREMENT,
  `kd_resep` varchar(50) NOT NULL,
  `kd_bahanbk` varchar(50) NOT NULL,
  `takaran` text NOT NULL,
  PRIMARY KEY (`kd_detresep`),
  KEY `FK_resep090` (`kd_bahanbk`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `det_resep` */

insert  into `det_resep`(`kd_detresep`,`kd_resep`,`kd_bahanbk`,`takaran`) values (1,'RS-0001','BAHAN-0001','2 Sendok'),(2,'RS-0001','BAHAN-0002','3 sendok'),(4,'RS-0002','BAHAN-0001','3 Sendok'),(5,'RS-0002','BAHAN-0002','2 sendok'),(7,'RS-0003','BAHAN-0002','2 Sendok'),(8,'RS-0003','BAHAN-0003','200 ml');

/*Table structure for table `detbrg_keluar` */

DROP TABLE IF EXISTS `detbrg_keluar`;

CREATE TABLE `detbrg_keluar` (
  `kd_detbrgout` int(11) NOT NULL AUTO_INCREMENT,
  `kd_brgout` varchar(50) NOT NULL,
  `kd_bahanbk` varchar(50) NOT NULL,
  `jum_brgout` int(11) NOT NULL,
  PRIMARY KEY (`kd_detbrgout`),
  KEY `FK_brg_keluar13` (`kd_bahanbk`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `detbrg_keluar` */

insert  into `detbrg_keluar`(`kd_detbrgout`,`kd_brgout`,`kd_bahanbk`,`jum_brgout`) values (1,'OUT-202010001','BAHAN-0002',2),(2,'OUT-202010002','BAHAN-0006',2),(3,'OUT-202010003','BAHAN-0003',2),(4,'OUT-202010004','BAHAN-0006',2);

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `kd_kategori` varchar(50) NOT NULL,
  `nm_kategori` varchar(100) NOT NULL,
  PRIMARY KEY (`kd_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `kategori` */

insert  into `kategori`(`kd_kategori`,`nm_kategori`) values ('KTGR-01','Base'),('KTGR-02','Cheestea'),('KTGR-03','Machiato');

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `kd_menu` varchar(50) NOT NULL,
  `kd_kategori` varchar(50) NOT NULL,
  `nm_menu` varchar(100) NOT NULL,
  `gambar` varchar(500) DEFAULT NULL,
  `size` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `menu` */

insert  into `menu`(`kd_menu`,`kd_kategori`,`nm_menu`,`gambar`,`size`,`harga`,`keterangan`) values ('MENU-0001','KTGR-01','Original','07102020021149photo4.jpg','Medium',15000,'Tidak Tersedia'),('MENU-0002','KTGR-02','asasas','07102020021334AdminLTELogo.png','Medium',12000,'Tersedia'),('MENU-0003','KTGR-02','asasasasas','07102020021619avatar.png','Medium',12000,'Tersedia'),('MENU-0004','KTGR-01','Green Tea','08102020013220photo4.jpg','Small',12000,'Tidak Tersedia'),('MENU-0005','KTGR-01','asasas','07102020023700avatar04.png','Medium',12000,'Tersedia'),('MENU-0006','KTGR-01','sasa','07102020023936default-150x150.png','Medium',1200,'Tersedia');

/*Table structure for table `pegawai` */

DROP TABLE IF EXISTS `pegawai`;

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(50) NOT NULL,
  `nm_pegawai` varchar(100) NOT NULL,
  `jk` varchar(30) NOT NULL,
  `status` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` char(15) NOT NULL,
  PRIMARY KEY (`id_pegawai`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pegawai` */

insert  into `pegawai`(`id_pegawai`,`nm_pegawai`,`jk`,`status`,`alamat`,`no_telp`) values ('PGW-0001','Waryuni','Perempuan','Admin','Trini, Sleman','081209090987'),('PGW-0002','Diki Setiawan','Laki-Laki','Admin','Gamping','08679012180');

/*Table structure for table `pembelian` */

DROP TABLE IF EXISTS `pembelian`;

CREATE TABLE `pembelian` (
  `id_pembelian` varchar(50) NOT NULL,
  `id_suplier` varchar(50) NOT NULL,
  `kd_bahanbk` varchar(50) NOT NULL,
  `tgl_beli` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `id_pegawai` varchar(50) NOT NULL,
  `tgl_exp` date NOT NULL,
  PRIMARY KEY (`id_pembelian`),
  KEY `FK_pembelian` (`id_suplier`),
  KEY `FK_pembelian_bahanbk` (`kd_bahanbk`),
  KEY `FK_pembelian2` (`id_pegawai`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pembelian` */

insert  into `pembelian`(`id_pembelian`,`id_suplier`,`kd_bahanbk`,`tgl_beli`,`jumlah`,`harga`,`id_pegawai`,`tgl_exp`) values ('PMBL-00001','SUPLY-0002','BAHAN-0004','2020-10-13',12,12000,'PGW-0001','2021-01-01'),('PMBL-00002','SUPLY-0001','BAHAN-0005','2020-10-13',2,450000,'PGW-0001','2021-04-04'),('PMBL-00003','SUPLY-0002','BAHAN-0007','2020-10-14',10,30000,'PGW-0001','2021-10-14');

/*Table structure for table `resep` */

DROP TABLE IF EXISTS `resep`;

CREATE TABLE `resep` (
  `kd_resep` varchar(50) NOT NULL,
  `kd_menu` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_resep`),
  KEY `FK_resep` (`kd_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `resep` */

insert  into `resep`(`kd_resep`,`kd_menu`) values ('RS-0001','MENU-0001'),('RS-0002','MENU-0004'),('RS-0003','MENU-0005');

/*Table structure for table `stok` */

DROP TABLE IF EXISTS `stok`;

CREATE TABLE `stok` (
  `kd_stok` int(11) NOT NULL AUTO_INCREMENT,
  `kd_bahanbk` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  PRIMARY KEY (`kd_stok`),
  KEY `FK_stok` (`kd_bahanbk`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `stok` */

insert  into `stok`(`kd_stok`,`kd_bahanbk`,`stok`) values (1,'BAHAN-0001',6),(2,'BAHAN-0002',35),(4,'BAHAN-0003',5),(6,'BAHAN-0004',12),(7,'BAHAN-0005',1),(8,'BAHAN-0006',8),(9,'BAHAN-0007',10);

/*Table structure for table `suplier` */

DROP TABLE IF EXISTS `suplier`;

CREATE TABLE `suplier` (
  `id_suplier` varchar(50) NOT NULL,
  `nm_suplier` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(20) NOT NULL,
  `norek` varchar(100) NOT NULL,
  `bank` varchar(50) NOT NULL,
  PRIMARY KEY (`id_suplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `suplier` */

insert  into `suplier`(`id_suplier`,`nm_suplier`,`alamat`,`telp`,`norek`,`bank`) values ('SUPLY-0001','Unilever','Semarang','08909121900','12000909800','BCA'),('SUPLY-0002','Nestle','Semarang','0890912109','1234087666690','Mandiri'),('SUPLY-0003','Tirta Kencana','Sleman','089102121090','19209090012','BRI');

/*Table structure for table `tmp_detresep` */

DROP TABLE IF EXISTS `tmp_detresep`;

CREATE TABLE `tmp_detresep` (
  `kd_detresep` int(11) NOT NULL AUTO_INCREMENT,
  `kd_resep` varchar(50) NOT NULL,
  `kd_bahanbk` varchar(50) NOT NULL,
  `takaran` text NOT NULL,
  PRIMARY KEY (`kd_detresep`),
  KEY `FK_resep090` (`kd_bahanbk`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tmp_detresep` */

insert  into `tmp_detresep`(`kd_detresep`,`kd_resep`,`kd_bahanbk`,`takaran`) values (1,'RS-0001','BAHAN-0001','2 Sendok'),(2,'RS-0001','BAHAN-0002','3 sendok'),(3,'RS-0002','BAHAN-0001','3 Sendok'),(5,'RS-0002','BAHAN-0002','2 sendok'),(6,'RS-0003','BAHAN-0002','2 Sendok'),(7,'RS-0003','BAHAN-0003','200 ml');

/*Table structure for table `tmpdetbrg_keluar` */

DROP TABLE IF EXISTS `tmpdetbrg_keluar`;

CREATE TABLE `tmpdetbrg_keluar` (
  `kd_detbrgout` int(11) NOT NULL AUTO_INCREMENT,
  `kd_brgout` varchar(50) NOT NULL,
  `kd_bahanbk` varchar(50) NOT NULL,
  `jum_brgout` int(11) NOT NULL,
  PRIMARY KEY (`kd_detbrgout`),
  KEY `FK_brg_keluar13` (`kd_bahanbk`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tmpdetbrg_keluar` */

insert  into `tmpdetbrg_keluar`(`kd_detbrgout`,`kd_brgout`,`kd_bahanbk`,`jum_brgout`) values (1,'OUT-202010001','BAHAN-0002',2),(2,'OUT-202010002','BAHAN-0006',2),(3,'OUT-202010003','BAHAN-0003',2),(4,'OUT-202010004','BAHAN-0006',2);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id_pegawai` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `level` varchar(50) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`no`,`id_pegawai`,`email`,`password`,`level`) values (1,'PGW-0001','waryuni@gmail.com','$2y$10$WhWOjdyeGpAEJGs2/K6Ph.Cy3jWVg8mPBZ09g013hvXzTTfq4KbTq','Admin'),(2,'PGW-0002','dikiset@gmail.com','$2y$10$NSnGV9l8TO13nGk3rMv2CedZmZ6WOi4PGL63uiGvwbCclHMxBGKpe','Admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
