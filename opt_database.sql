/*
Navicat MySQL Data Transfer

Source Server         : gg
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : opt_database

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2016-07-03 02:48:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for opt_complaint
-- ----------------------------
DROP TABLE IF EXISTS `opt_complaint`;
CREATE TABLE `opt_complaint` (
  `id_complaint` int(11) NOT NULL AUTO_INCREMENT,
  `id_complaint_type` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_complaint_status` int(11) DEFAULT NULL,
  `desc_complaint` varchar(300) DEFAULT NULL,
  `img_complaint` varchar(500) DEFAULT NULL,
  `lat_complaint` varchar(100) DEFAULT NULL,
  `lon_complaint` varchar(100) DEFAULT NULL,
  `date_complaint` datetime DEFAULT NULL,
  `like_complaint` int(20) DEFAULT '1',
  PRIMARY KEY (`id_complaint`),
  KEY `fk_user` (`id_user`),
  KEY `fk_complaint_type` (`id_complaint_type`),
  KEY `fk_complaint_status` (`id_complaint_status`),
  CONSTRAINT `fk_complaint_status` FOREIGN KEY (`id_complaint_status`) REFERENCES `opt_complaint_status` (`id_complaint_status`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_complaint_type` FOREIGN KEY (`id_complaint_type`) REFERENCES `opt_complaint_type` (`id_complaint_type`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `opt_users` (`id_user`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of opt_complaint
-- ----------------------------
INSERT INTO `opt_complaint` VALUES ('2', '1', '1', '2', 'Es muy inseguro por la tarde-noche', 'alumbrado1.jpg', '20.077713', '-98.352188', '2016-03-07 11:15:14', '1');
INSERT INTO `opt_complaint` VALUES ('3', '1', '1', '3', 'Hay alumbrado pero no funciona', 'alumbrado2.jpg', '20.080635', '-98.350321', '2016-03-16 11:19:08', '1');
INSERT INTO `opt_complaint` VALUES ('4', '2', '2', '1', 'La carretera esta muy fea debido a las lluvias', 'bache5.jpg', '20.083597', '-98.357595', '2016-01-25 11:22:16', '2');
INSERT INTO `opt_complaint` VALUES ('5', '2', '2', '2', 'Hay demaciados baches en esta area', 'bache4.jpg', '20.084124', '-98.369205', '2016-03-13 11:26:12', '5');
INSERT INTO `opt_complaint` VALUES ('6', '2', '2', '1', 'Mal reaparado el asfalto', 'bache3.jpg', '20.0793637', '-98.3704684', '2016-02-22 11:28:20', '5');
INSERT INTO `opt_complaint` VALUES ('8', '3', '3', '2', 'Hay una tabla de la construccion de una fuente que esta apunto de caer', 'obra1.jpg', '20.079624', '-98.372156', '2016-01-01 11:39:35', '6');
INSERT INTO `opt_complaint` VALUES ('9', '3', '3', '1', 'Dejaron en mal estado las banquetas despues de una obra', 'obra2.jpg', '20.077135', '-98.370740', '2016-01-11 11:42:18', '3');
INSERT INTO `opt_complaint` VALUES ('10', '1', '1', '3', 'Faltan mas lamparas', 'alumbrado3.jpg', '20.079529', '-98.366461', '2016-01-03 11:43:15', '5');
INSERT INTO `opt_complaint` VALUES ('11', '1', '1', '2', 'No funciona', 'alumbrado4.jpg', '20.083267', '-98.362806', '2016-02-18 11:44:42', '1');
INSERT INTO `opt_complaint` VALUES ('12', '2', '1', '3', 'se daño mi auto por culpa del bache', 'bache2.jpg', '20.086834', '-98.366545', '2016-03-16 11:46:08', '1');
INSERT INTO `opt_complaint` VALUES ('13', '2', '1', '3', 'En este lugar hay un bache demaciado grande', 'bache1.jpg', '20.081340', '-98.368042', '2016-05-01 11:47:20', '5');
INSERT INTO `opt_complaint` VALUES ('14', '3', '2', '3', 'Estan arreglando una fuente', 'obra3.jpg', '20.077851', '-98.368203', '2016-01-26 11:49:07', '1');
INSERT INTO `opt_complaint` VALUES ('20', '4', '3', '2', 'Se esta saliendo el agua del drenaje y el olor es insoportable.', 'OPT_9WAIU49VP6RWYI0LJLSL.jpg', '20.07448833333333', '-98.40444333333335', '2016-04-20 18:09:24', '2');
INSERT INTO `opt_complaint` VALUES ('21', '1', '3', '1', 'No funciona el alumbrado publico en La Morena.', 'OPT_LLLY530VF71C2JU8MUNM.jpg', '20.07545', '-98.40363333333335', '2016-04-20 18:36:48', '1');
INSERT INTO `opt_complaint` VALUES ('22', '4', '3', '1', 'no hay alumbrado', 'OPT_JLU12YPBOINE2TX9DKQD.jpg', '20.075076666666668', '-98.40505', '2016-04-21 17:50:06', '1');

-- ----------------------------
-- Table structure for opt_complaint_status
-- ----------------------------
DROP TABLE IF EXISTS `opt_complaint_status`;
CREATE TABLE `opt_complaint_status` (
  `id_complaint_status` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_complaint_status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of opt_complaint_status
-- ----------------------------
INSERT INTO `opt_complaint_status` VALUES ('1', 'Recibido');
INSERT INTO `opt_complaint_status` VALUES ('2', 'En progreso');
INSERT INTO `opt_complaint_status` VALUES ('3', 'Completado');

-- ----------------------------
-- Table structure for opt_complaint_type
-- ----------------------------
DROP TABLE IF EXISTS `opt_complaint_type`;
CREATE TABLE `opt_complaint_type` (
  `id_complaint_type` int(11) NOT NULL AUTO_INCREMENT,
  `name_complaint_type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_complaint_type`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of opt_complaint_type
-- ----------------------------
INSERT INTO `opt_complaint_type` VALUES ('1', 'Alumbrado público');
INSERT INTO `opt_complaint_type` VALUES ('2', 'Baches');
INSERT INTO `opt_complaint_type` VALUES ('3', 'Obras en progreso');
INSERT INTO `opt_complaint_type` VALUES ('4', 'Otros');

-- ----------------------------
-- Table structure for opt_users
-- ----------------------------
DROP TABLE IF EXISTS `opt_users`;
CREATE TABLE `opt_users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_type` int(11) DEFAULT NULL,
  `name_user` varchar(100) DEFAULT NULL,
  `email_user` varchar(100) DEFAULT NULL,
  `password_user` varchar(200) DEFAULT NULL,
  `active_user` int(1) DEFAULT '1',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `unique_email` (`email_user`) USING BTREE,
  KEY `fk_user_type` (`id_user_type`),
  CONSTRAINT `fk_user_type` FOREIGN KEY (`id_user_type`) REFERENCES `opt_users_type` (`id_user_type`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of opt_users
-- ----------------------------
INSERT INTO `opt_users` VALUES ('1', '2', 'Martin Diaz del Razo', 'panda-bmx1@hotmail.com', '$2y$10$ObrasPublicasTulancinefXviAlvh6ytQQRsRQIskNyE7u4Tf0wu', '1');
INSERT INTO `opt_users` VALUES ('2', '1', 'Esteban Juarez Rodriguez', 'esteban@outlook.com', '$2y$10$ObrasPublicasTulancine/AyNTLjk3H0.QXTUZK1FyLX4PS9/t62', '1');
INSERT INTO `opt_users` VALUES ('3', '3', 'Cruz Eduardo Romero Castro', 'lalo@hotmail.com', '$2y$10$ObrasPublicasTulancinefXviAlvh6ytQQRsRQIskNyE7u4Tf0wu', '1');
INSERT INTO `opt_users` VALUES ('32', '3', 'Ángel gayoso', 'angel.g@outlook.com', '$2y$10$ObrasPublicasTulancinefXviAlvh6ytQQRsRQIskNyE7u4Tf0wu', '1');
INSERT INTO `opt_users` VALUES ('34', '3', 'Oscar Martinez Arevalo', 'oscar.beni@hotmail.com', '$2y$10$ObrasPublicasTulancineZPr11h2CEdSbEo2M3.XvAWBayKTaxBG', '1');
INSERT INTO `opt_users` VALUES ('35', '1', 'Martin  Diaz del Razo', 'martin@outlook.com', '$2y$10$ObrasPublicasTulancinefXviAlvh6ytQQRsRQIskNyE7u4Tf0wu', '1');
INSERT INTO `opt_users` VALUES ('36', '1', 'esteban@hotmail.com', 'esteban@hotmail.com', '$2y$10$ObrasPublicasTulancinefXviAlvh6ytQQRsRQIskNyE7u4Tf0wu', '1');

-- ----------------------------
-- Table structure for opt_users_type
-- ----------------------------
DROP TABLE IF EXISTS `opt_users_type`;
CREATE TABLE `opt_users_type` (
  `id_user_type` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of opt_users_type
-- ----------------------------
INSERT INTO `opt_users_type` VALUES ('1', 'Administrador');
INSERT INTO `opt_users_type` VALUES ('2', 'Supervisor');
INSERT INTO `opt_users_type` VALUES ('3', 'Usuario');
