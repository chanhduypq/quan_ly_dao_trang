/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : quan_ly_dao_trang

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2018-05-17 10:22:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for columns
-- ----------------------------
DROP TABLE IF EXISTS `columns`;
CREATE TABLE `columns` (
  `columns` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of columns
-- ----------------------------
INSERT INTO `columns` VALUES ('[\"ho_va_ten\",\"phap_danh\",\"nam_sinh\",\"gioi_tinh\",\"nghe_nghiep\",\"dien_thoai\",\"dia_chi_tam_tru\",\"dia_chi_thuong_tru\",\"ngay_dk_tham_gia\",\"nguoi_gioi_thieu\"]');

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
  `hinh_anh` varchar(255) DEFAULT NULL,
  `ho` varchar(255) DEFAULT NULL,
  `ten` varchar(255) DEFAULT NULL,
  `phap_danh` varchar(255) DEFAULT NULL,
  `nam_sinh` varchar(100) DEFAULT NULL,
  `gioi_tinh` varchar(10) DEFAULT NULL,
  `nghe_nghiep` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `cmnd` varchar(20) DEFAULT NULL,
  `dien_thoai` varchar(255) DEFAULT NULL,
  `dia_chi_tam_tru` varchar(1000) DEFAULT NULL,
  `dia_chi_thuong_tru` varchar(1000) DEFAULT NULL,
  `ngay_dk_tham_gia` varchar(100) DEFAULT NULL,
  `nguoi_gioi_thieu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of thanh_vien
-- ----------------------------
INSERT INTO `thanh_vien` VALUES ('145', 'bb0dd630a69c009c3a578d411664a74f.jpeg', 'Võ Thị Ngọc', 'Ánh', 'Diệu Ngọc', '2/1/1959', 'Nữ', 'Buôn bán', null, null, null, '0128 269 9489', '216 Lê Thanh Nghị', '216 Lê Thanh Nghị', '3/15/2015', 'Tường Đức');
INSERT INTO `thanh_vien` VALUES ('146', '655c5e7ba4b82e6ccefc00c4b3ff46a5.jpeg', 'Nguyễn Văn', 'Bảo', 'Trí Pháp Liêm', '2/3/1952', 'Nam', null, null, null, null, '0913 402 486', '23 Tống Phước Phổ,Hải Châu, DN', '23 Tống Phước Phổ,Hải Châu, DN', 'Năm 2013', 'Tường Đức');
INSERT INTO `thanh_vien` VALUES ('147', 'dad7d4121be01bde6fb5be791d3f0f48.jpeg', 'Nguyễn Thị', 'Cúc', 'Thanh Đức Bình', '29/1/1961', 'Nữ', 'Nội trợ', null, null, null, '0934 811 125', '498/2 Trần Cao Vân', '498/2 Trần Cao Vân', 'Năm 2009', 'Chùa TT Phật Quang');
INSERT INTO `thanh_vien` VALUES ('148', 'ac75da7e5d055aaf9b7e1adb172893e2.jpeg', 'Phạm Phú', 'Đãi', 'Thiện Định Ánh', '1/2/1960', 'Nam', 'Làm vườn', null, null, null, '01202727552', 'Hòa Phú', 'Hòa Phú', 'Năm 2009', 'Thanh Đức Khương');
INSERT INTO `thanh_vien` VALUES ('149', 'adeb0925d01386d0857b0d6691eb5937.jpg', 'Trần Tuyết', 'Hạnh', 'Mẫn Giới Hậu', '21/5/1978', 'Nữ', 'Kinh doanh', 'hanhtien117@gmail.com', null, null, '0905 434 307', '117 Núi Thành, ĐN', '117 Núi Thành, ĐN', '7/28/2015', 'Tường Đức');
INSERT INTO `thanh_vien` VALUES ('150', 'ae029eade4ec6ccd301b19846ce3e5d2.jpeg', 'Tôn Nữ Như ', 'Hoa', 'Tường Đức', '5/10/1956', 'Nữ', 'Bác sĩ', 'tuongduc_pq@ymail.com', null, null, '0986979197', '95 Nguyễn Chí Thanh, ĐN', '95 Nguyễn Chí Thanh, ĐN', 'Trước ngày thành lập 17/9/2006', 'Nghe băng giảng của Sư Phụ');
INSERT INTO `thanh_vien` VALUES ('151', 'f91e3a004d70f9beb7cda7a974fc3a13.jpeg', 'Phạm Thị ', 'Hoa', 'Huệ Thành Mỹ', '27/12/1974', 'Nữ', 'May', null, null, null, '0913423875', 'Hòa Phú', 'Hòa Phú', 'Năm 2009', 'Thanh Đức Khương');
INSERT INTO `thanh_vien` VALUES ('152', '998d6d1e31256dbb70866703993fb1e6.jpeg', 'Phạm Thị Ngọc', 'Huyền', 'Thanh Phúc Ấn', '25/8/1954', 'Nữ', null, null, null, null, '0169 833 3717', 'H06/58 K92 Đinh Tiên Hoàng', 'H06/58 K92 Đinh Tiên Hoàng', '5/30/2007', 'Hiệp');
INSERT INTO `thanh_vien` VALUES ('153', 'b7fc0dbeeee39ce1c8c8324954612063.jpeg', 'Hoàng Thị', 'Kim', 'Mẫn Giới Đoan', '11/3/1977', 'Nữ', 'NVVP', 'hoangkim110377@gmail.com', null, null, '0905 118 867', '02 Đinh Tiên Hoàng, ĐN', '3 Đinh Tiên Hoàng, ĐN', '7/28/2015', 'Tường Đức');
INSERT INTO `thanh_vien` VALUES ('154', 'ce80186969f1723e396363f6c8d01d35.jpeg', 'Lê Thị Ngọc', 'Lan', 'Châu Diệu', '1/1/1972', 'Nữ', 'Buôn bán', null, null, null, '0988 789 539', 'Hòa Phú', 'Hòa Phú', 'Năm 2008', 'Thanh Đức Khương');
INSERT INTO `thanh_vien` VALUES ('155', '0b97bf58bf98fbfcb3726195e21da5fc.jpeg', 'Lưu Kim ', 'Liên', 'Thanh Định Giải', '28/3/1964', 'Nữ', 'Nội trợ', null, null, null, '0934899290', 'K322/H23/01 Hải Phòng', 'K322/H23/01 Hải Phòng', 'Năm 2008', 'Thanh Định Giác');
INSERT INTO `thanh_vien` VALUES ('156', 'f424628adc9f3fa8f461263807cc3d49.jpeg', 'Phạm Thị ', 'Liên', 'Thanh Đức Khương', '20/10/1966', 'Nữ', 'Buôn bán', 'duckhuongpq@gmail.com', null, null, '0974 702 809', 'Hòa Phú', 'Hòa Phú', 'Năm 2009', 'Thái Định');
INSERT INTO `thanh_vien` VALUES ('157', 'e464d5347732d96d8c3c68ceaf570a5f.jpeg', 'Nguyễn Kim', 'Liên', 'Nguyên Đài', '15/12/1985', 'Nữ', 'HDV du lịch', 'kimbinh22983@gmail.com', null, null, '0125 520 4811', '132 Lê Thạch, Đà Nẵng', 'Huế', '7/31/2014', 'Chị Phước Nguyện');
INSERT INTO `thanh_vien` VALUES ('158', '63e0d1fbee472e760108424a143f8b41.jpeg', 'Hồ Thị', 'Mơ', 'Chúc Hiền', '26/10/1956', 'Nữ', 'Buôn bán', null, null, null, '0905563402', 'Thôn Ngân Giang - Điện Ngọc', 'Thôn Ngân Giang - Điện Ngọc', 'Năm 2009', 'Tường Đức');
INSERT INTO `thanh_vien` VALUES ('159', '6f6bc54861418cb1ecf5adce058acbe3.jpeg', 'Trần Thị Bích ', 'Ngọc', 'Huệ Thánh Châu', '16/9/1959', 'Nữ', null, null, null, null, '0986 699 532', 'K106/1 Huỳnh Thúc Kháng, ĐN', 'K106/1 Huỳnh Thúc Kháng, ĐN', 'Năm 2013', 'Huệ Đăng Quỳnh');
INSERT INTO `thanh_vien` VALUES ('160', 'de4244a8cab63875d1954b283c724172.jpeg', 'Nguyễn Văn ', 'Phát', 'Thiện Hoà Toàn', '16/3/1975', 'Nam', 'Marketting', 'phatdanang@gmail.com', null, null, '0918912351', 'Tổ 5 Hòa Trung, Vĩnh Hòa.', 'Tổ 5 Hòa Trung, Vĩnh Hòa', '7/2012', 'Chùa TT Phật Quang');
INSERT INTO `thanh_vien` VALUES ('161', 'bce310d8e5f2c9224b1e67518c567b78.jpeg', 'Lê Thị Kim', 'Phương', null, '19/8/1977', 'Nữ', 'Nhân viên VP', 'lekimphuong77@gmail.com', null, null, '0905 140 999', '17 Tố Hữu', '17 Tố Hữu', '9/22/2014', 'Tường Đức');
INSERT INTO `thanh_vien` VALUES ('162', null, 'Hồ Thị Quỳnh', 'Phương', 'Minh Châu', '16/7/1979', 'Nữ', 'Kinh doanh', null, null, null, '0913 948 159', '510 Trần Cao Vân', '510 Trần Cao Vân', '12/4/2014', 'Thanh Huyền Chi');
INSERT INTO `thanh_vien` VALUES ('163', '582f13257a0b4bbed91a29cc49452b68.jpeg', 'Trần Thị Ngọc', 'Phương', 'Quãng Thảo', '26/9/1956', 'Nữ', 'Buôn bán', null, null, null, '0163 248 4452', '742/3 Trường Chinh', '742/3 Trường Chinh', '3/15/2015', 'Tường Đức');
INSERT INTO `thanh_vien` VALUES ('164', '8705429b246ccc5bb786c3197bae6886.jpeg', 'Phan Tấn ', 'Tâm', 'Thái Định', '25/5/1973', 'Nam', 'Kế toán', 'tantam73@yahoo.com', null, null, '0966938983', '251 Trưng Nữ Vương', '251 Trưng Nữ Vương', 'Trước ngày thành lập 17/9/2006', 'Tự tìm đến với ĐT');
INSERT INTO `thanh_vien` VALUES ('165', 'e7a5a778837c4e107e92ea8069a2bc8b.jpeg', 'Nguyễn Thị ', 'Tâm', 'Huệ Tường Hội', '1/8/1961', 'Nữ', 'Kế toán', null, null, null, '01257 783 988', ' 141 Lê Đình Dương, Đà Nẵng', ' 141 Lê Đình Dương, Đà Nẵng', '9/2013', 'Tường Đức');
INSERT INTO `thanh_vien` VALUES ('166', '8de5485c503c277cfb2ca766edab044b.jpeg', 'Lê Thị Huyền ', 'Trang', 'Nguyệt Nhuận Hảo', '24/6/1983', 'Nữ', 'Làm bánh', null, null, null, '0905741626', '343/16 Trưng Nữ Vương', '343/16 Trưng Nữ Vương', '9/17/2006', 'Tường Đức');
INSERT INTO `thanh_vien` VALUES ('167', '3b1ddfdf0d14c3ae7867e6d0999fa307.jpeg', 'Văn Thị Cẩm ', 'Vân', 'Nguyệt Hiền', '0/0/1968', 'Nữ', 'Giáo viên', null, null, null, '0982991861', '99/01 Hoàng Hoa Thám', '99/01 Hoàng Hoa Thám', 'Năm 2007', 'Nguyệt Thiện');
INSERT INTO `thanh_vien` VALUES ('168', 'e5a0987dfe29ee3a51005233f27a334c.jpeg', 'Huỳnh Thị', 'Vũ', 'Mẫn Phước Viên', '16/10/1969', 'Nữ', 'Buôn bán', null, null, null, '0166 482 9283', '26 Hoàng Văn Hòe, ĐN', '26 Hoàng Văn Hòe, ĐN', '3/18/2015', 'Huệ Vi Hương');
INSERT INTO `thanh_vien` VALUES ('169', '43cfca7474f4f0287cde926fc80d0c60.jpeg', 'Nguyễn Ngọc ', 'Duy', 'Đồng Hải Tập', '12/6/1980', 'Nam', 'Thợ Mộc', 'ngocduy@gmail.com', 'duy nguyễn ngọc', '0914897447', null, null, '30/08/2016', 'Cô Hoa', null);
INSERT INTO `thanh_vien` VALUES ('170', 'ae12b43767b4e42f8ce8664f66129ba0.jpeg', 'Đoàn Thị ', 'Dung', 'Quý Ngọc', '5/26/1905', 'Nữ', null, null, null, null, '742 Trường Chinh', 'Đà Nẵng', '10/29/2016', 'Cô Phương', null);
INSERT INTO `thanh_vien` VALUES ('171', '0f215f7bacb67d1ed432d99c76b946a7.jpeg', 'Nguyễn Thị ', 'Công', 'Nhuận Nguyên Danh', '10/17/1971', 'Nữ', 'CBCNV Thư Viện', 'nguyenthicongnth@gmail.com', null, '0905062378', '29 an thuong 21 - Ngũ Hành Sơn', 'Đà Nẵng', '10/29/2016', null, null);
INSERT INTO `thanh_vien` VALUES ('172', 'a8390a0921b4a273a3a58715488a4e42.jpeg', 'Đặng Thị Kim', 'Phượng', 'Mẫn Phước Nhân', '9/15/1984', 'Nữ', 'Nhân viên bán hàng', 'dangthikimphuong.rose@gmail.com ', null, '0905 958 595', '152 Võ Như Hưng, ĐN', 'Đaà Nẵng', '11/10/2015', 'Huệ Vi Hương', null);
INSERT INTO `thanh_vien` VALUES ('173', '5d8b927224b7321bcdb3b19e7b2375c5.jpeg', 'Lê Hữu', 'Phước', null, '7/15/1961', 'Nam', 'KSXD', 'phuoccha@gmail.com', null, '0913631757', '368/20 hoàng diệu', 'Đà Nẵng', '10/29/2016', 'Cô Phương', null);
INSERT INTO `thanh_vien` VALUES ('174', 'fc951bc083642836ca8dc606cebcdb94.jpeg', 'Đoàn Thanh ', 'Trang', null, '3/1/1971', 'Nữ', 'Tiểu thương', null, null, '0905350441', '368/20 hoàng diệu', 'Đà Nẵng', '10/31/2016', 'Cô Phương', null);
INSERT INTO `thanh_vien` VALUES ('175', '8dcad0cd42c637dd4fd16e42b3431165.jpeg', 'Nguyễn Thị', 'Lênh', null, null, 'Nữ', null, null, null, '0126 355 2995', 'Khách sạn Hoa Bưởi', null, null, null, null);
INSERT INTO `thanh_vien` VALUES ('176', 'e8b88bde5f5084c049bb56893b6c4a2a.jpeg', 'Ngô Thị ', 'Đậu', null, '5/18/1965', 'Nữ', 'Nội trợ', null, null, '0121 4569429', null, null, null, null, null);
INSERT INTO `thanh_vien` VALUES ('177', 'ec5398cc8cf21216ea537fba8b6bbf4a.jpeg', 'Thiều', 'Song', 'Khải Đăng Chi', '1966', 'Nam', null, null, null, '0914 861 645', 'Hòa Phú', null, null, null, null);
INSERT INTO `thanh_vien` VALUES ('178', '6caf984818730aae20657e88225513f8.jpeg', null, null, 'Mẫn Pháp Giới\n(mẹ chị Hiếu Như)', null, 'Nữ', null, null, null, null, null, null, null, null, null);
INSERT INTO `thanh_vien` VALUES ('179', 'dc6e835df33302699720d01bf0f3b791.jpeg', null, null, 'Thanh Huyền Khôi', '5/10/1905', 'Nữ', null, null, null, null, '87 Lê Thị Hồng Gấm, TP Đà Nẵng', null, null, null, null);
INSERT INTO `thanh_vien` VALUES ('180', null, 'saddasda', null, null, null, 'Nam', null, null, null, null, null, null, null, null, null);
INSERT INTO `thanh_vien` VALUES ('181', 'e060424fa2545b971fdf85412c9f915b.jpg', 'ádsada', null, null, null, 'Nam', null, null, null, null, null, null, null, null, null);

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
