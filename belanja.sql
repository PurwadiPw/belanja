/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : belanja

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-05-24 19:41:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` varchar(10) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('161511028', 'putri', 'dian');

-- ----------------------------
-- Table structure for jual
-- ----------------------------
DROP TABLE IF EXISTS `jual`;
CREATE TABLE `jual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_penjualan` varchar(15) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(3) NOT NULL,
  `harga` mediumint(9) NOT NULL,
  `temp_session` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jual
-- ----------------------------
INSERT INTO `jual` VALUES ('31', 'PJL00001', '2', '2', '22000', '');
INSERT INTO `jual` VALUES ('32', 'PJL00001', '3', '1', '3450', '');

-- ----------------------------
-- Table structure for penjualan
-- ----------------------------
DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_penjualan` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(150) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of penjualan
-- ----------------------------
INSERT INTO `penjualan` VALUES ('8', 'PJL00001', '2018-05-24', 'Purwadi', '085220603036', 'Cimahi edit');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(60) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `product_desc` tinytext NOT NULL,
  `product_img_name` varchar(60) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `stock` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_code` (`product_code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', 'PD1001', 'Tomat', 'Minimal pembelian 1 Kilogram', '1.jpg', '6250', '5');
INSERT INTO `products` VALUES ('2', 'PD1002', 'Broccoli', 'Per-1 buah broccoli itu seberat 330 gram', '1.jpg', '11000', '3');
INSERT INTO `products` VALUES ('3', 'PD1003', 'Jagung', '1 buah jagung 330 gram', '1.jpg', '3450', '4');
INSERT INTO `products` VALUES ('4', 'PD1004', 'Wortel', 'Minimal Pembelian 500 Gram', '1.jpg', '5850', '5');
INSERT INTO `products` VALUES ('5', 'PD1005', 'Kentang', 'Minimal pembelian 5 KiloGram', '1.jpg', '12000', '5');
INSERT INTO `products` VALUES ('6', 'PD1006', 'Kemangi', 'Minimal pembelian 2 Kilo Gram', '1.jpg', '6000', '5');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_nama` varchar(255) DEFAULT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_telp` varchar(15) DEFAULT NULL,
  `user_alamat` text,
  `user_level` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'admin', 'd41d8cd98f00b204e9800998ecf8427e', 'admin', 'admin', 'admin', 'admin');
INSERT INTO `user` VALUES ('2', 'Nama', 'nama', 'd41d8cd98f00b204e9800998ecf8427e', 'email@yahoo.com', '089089089', 'Alamat', 'member');
INSERT INTO `user` VALUES ('3', 'Overhang', 'overhang', 'd41d8cd98f00b204e9800998ecf8427e', 'overhang@yahoo.com', '089123123123', 'Kp. Baros Seneng Rt.03 Rw.03 Kel. Utama Kec. CImahi Selatan Kota Cimahi', 'member');
INSERT INTO `user` VALUES ('4', 'Purwadi', 'purwadi', 'd41d8cd98f00b204e9800998ecf8427e', 'purwadipw99@yahoo.com', '085220603036', 'Cimahi edit', 'member');
