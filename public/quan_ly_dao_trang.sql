/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : quan_ly_dao_trang

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2018-05-13 10:26:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for footer
-- ----------------------------
DROP TABLE IF EXISTS `footer`;
CREATE TABLE `footer` (
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of footer
-- ----------------------------
INSERT INTO `footer` VALUES ('<p style=\"text-align:center\">&copy;Đạo tr&agrave;ng Phật Đ&agrave;</p>\r\n\r\n<p style=\"text-align:center\">Li&ecirc;n hệ: Đạo tr&agrave;ng Phật Đ&agrave;</p>\r\n');

-- ----------------------------
-- Table structure for header_text
-- ----------------------------
DROP TABLE IF EXISTS `header_text`;
CREATE TABLE `header_text` (
  `text` varchar(255) NOT NULL,
  `dynamic` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of header_text
-- ----------------------------
INSERT INTO `header_text` VALUES ('Quản lý đạo tràng', '0');

-- ----------------------------
-- Table structure for hinh_nen
-- ----------------------------
DROP TABLE IF EXISTS `hinh_nen`;
CREATE TABLE `hinh_nen` (
  `file_name` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hinh_nen
-- ----------------------------
INSERT INTO `hinh_nen` VALUES ('/images/database/hinhnen/_ccba5432efd2074fe7c15b991cb449545ab53b470f5828.14995862.jpg');

-- ----------------------------
-- Table structure for home_content
-- ----------------------------
DROP TABLE IF EXISTS `home_content`;
CREATE TABLE `home_content` (
  `content` longtext,
  `bg` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of home_content
-- ----------------------------
INSERT INTO `home_content` VALUES ('<p>Xin ch&agrave;o mọi người.</p>\r\n', '');

-- ----------------------------
-- Table structure for logo
-- ----------------------------
DROP TABLE IF EXISTS `logo`;
CREATE TABLE `logo` (
  `file_name` varchar(1000) NOT NULL,
  `dynamic` int(1) DEFAULT NULL,
  `show` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of logo
-- ----------------------------
INSERT INTO `logo` VALUES ('/images/database/logo/_ea5460235427bc49f3f8c13f5a0735a85ac0f2b17060f3.87725081.jpg', '0', '0');

-- ----------------------------
-- Table structure for thanh_vien
-- ----------------------------
DROP TABLE IF EXISTS `thanh_vien`;
CREATE TABLE `thanh_vien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ho_ten` varchar(255) DEFAULT NULL,
  `phap_danh` varchar(255) DEFAULT NULL,
  `que_quan` varchar(255) DEFAULT NULL,
  `nam_sinh` int(11) DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `thong_tin_khac` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of thanh_vien
-- ----------------------------
INSERT INTO `thanh_vien` VALUES ('6', 'tuệ', 'chánh duy', 'đà nẵng', '1984', '1984-12-08', 'dfgdfg');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `danh_xung` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'Danh xưng (anh/chị)',
  `full_name` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'Tên đầy đủ (Minh Kỳ)',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `is_download` tinyint(1) DEFAULT NULL,
  `is_upload` tinyint(1) DEFAULT NULL,
  `is_thongke` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('3', 'Chị', 'Ngọc Lan', 'daotrangphatda2018@gmail.com', null, '7c4a8d09ca3762af61e59520943dc26494f8941b', '1', '1', '1', '1');

-- ----------------------------
-- View structure for layout_content
-- ----------------------------
DROP VIEW IF EXISTS `layout_content`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `layout_content` AS SELECT header_text.text as header_text,header_text.dynamic as dynamic_header_text,logo.file_name,logo.`show`,logo.dynamic as dynamic_logo,footer.text as footer_text,hinh_nen.file_name as hinh_nen_file_name from hinh_nen,footer,header_text,logo ;
