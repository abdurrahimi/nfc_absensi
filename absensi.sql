/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100413
Source Host           : localhost:3306
Source Database       : absensi

Target Server Type    : MYSQL
Target Server Version : 100413
File Encoding         : 65001

Date: 2020-08-21 09:36:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for api_log
-- ----------------------------
DROP TABLE IF EXISTS `api_log`;
CREATE TABLE `api_log` (
  `ApiAccessLogID` bigint(20) NOT NULL AUTO_INCREMENT,
  `SignatureKey` varchar(255) DEFAULT NULL,
  `IpClient` varchar(255) DEFAULT NULL,
  `IpClientForward` varchar(255) DEFAULT NULL,
  `UserAccessToken` varchar(255) DEFAULT NULL,
  `MethodRequest` varchar(255) DEFAULT NULL,
  `RequestParam` text DEFAULT NULL,
  `ResponseApi` text DEFAULT NULL,
  `ResponseStatus` text DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `MissedParam` text DEFAULT NULL,
  PRIMARY KEY (`ApiAccessLogID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of api_log
-- ----------------------------

-- ----------------------------
-- Table structure for api_signature
-- ----------------------------
DROP TABLE IF EXISTS `api_signature`;
CREATE TABLE `api_signature` (
  `SignatureID` int(11) NOT NULL AUTO_INCREMENT,
  `SignatureKey` varchar(255) DEFAULT NULL,
  `ClientName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`SignatureID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of api_signature
-- ----------------------------
INSERT INTO `api_signature` VALUES ('1', 'dd7298aa1a5d2220ba3b11d82db4feb9a3bc908e', 'Android Apps');

-- ----------------------------
-- Table structure for area
-- ----------------------------
DROP TABLE IF EXISTS `area`;
CREATE TABLE `area` (
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `nama_area` varchar(255) DEFAULT NULL,
  `latlong_a` varchar(255) DEFAULT NULL,
  `latlong_b` varchar(255) DEFAULT NULL,
  `latlong_c` varchar(255) DEFAULT NULL,
  `latlong_d` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_area`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of area
-- ----------------------------
INSERT INTO `area` VALUES ('1', 'Sekolah', '-6.470884476572228, 106.86470247264297', '-6.469946352989619, 106.87412239070328', '-6.475020727953925, 106.87819934840591', '-6.481481097662082, 106.86927342052105');

-- ----------------------------
-- Table structure for ci_sessions
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT 0,
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of ci_sessions
-- ----------------------------
INSERT INTO `ci_sessions` VALUES ('00ac92827ff4d4f44d3c69eb71436d74', '192.168.137.87', 'okhttp/3.12.1', '1597956363', '');
INSERT INTO `ci_sessions` VALUES ('04608ea34ef2dd3b3d3068acb28a4ad2', '192.168.137.87', 'okhttp/3.12.1', '1597955822', '');
INSERT INTO `ci_sessions` VALUES ('08a08697708aa35518fdd6f61564d05e', '192.168.137.87', 'okhttp/3.12.1', '1597957583', '');
INSERT INTO `ci_sessions` VALUES ('0dee9e9d15083cd63275ed7e9902ee4d', '192.168.137.87', 'okhttp/3.12.1', '1597956720', '');
INSERT INTO `ci_sessions` VALUES ('162171de68e45c46c6197f4d072afabe', '192.168.137.87', 'okhttp/3.12.1', '1597958787', '');
INSERT INTO `ci_sessions` VALUES ('1bfef72935b6a160f3d4a8680209ded2', '192.168.137.87', 'okhttp/3.12.1', '1597956981', '');
INSERT INTO `ci_sessions` VALUES ('2371358f52f42c11487595276e3a251b', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36', '1597955677', 'a:2:{s:9:\"user_data\";s:0:\"\";s:9:\"loginData\";a:2:{s:7:\"user_id\";s:1:\"1\";s:8:\"username\";s:5:\"ADMIN\";}}');
INSERT INTO `ci_sessions` VALUES ('237aef953b9d2e08f9dcc3144d1e5c93', '192.168.137.87', 'okhttp/3.12.1', '1597954863', '');
INSERT INTO `ci_sessions` VALUES ('29fb3dfbc096ebce42c7373a4a4fa8bc', '192.168.137.87', 'okhttp/3.12.1', '1597955822', '');
INSERT INTO `ci_sessions` VALUES ('2dbe173ede9e42ce4685572fd2c5eae3', '192.168.137.87', 'okhttp/3.12.1', '1597957884', '');
INSERT INTO `ci_sessions` VALUES ('30060b1cf431cc2cb30d07db480645cf', '192.168.137.87', 'okhttp/3.12.1', '1597957282', '');
INSERT INTO `ci_sessions` VALUES ('311fdcb5822f02179e067a520df03d1f', '192.168.137.87', 'Mozilla/5.0 (Linux; Android 10; Redmi Note 8 Pro Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Versi', '1597956062', '');
INSERT INTO `ci_sessions` VALUES ('31b0ab392c7a45acabaf7117478d1ced', '192.168.137.87', 'Mozilla/5.0 (Linux; Android 10; Redmi Note 8 Pro Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Versi', '1597955822', '');
INSERT INTO `ci_sessions` VALUES ('37b7a48d3c9fa465209d661cd271b118', '192.168.137.87', 'okhttp/3.12.1', '1597955896', 'a:2:{s:9:\"user_data\";s:0:\"\";s:9:\"loginData\";a:2:{s:7:\"user_id\";s:1:\"1\";s:8:\"username\";s:5:\"ADMIN\";}}');
INSERT INTO `ci_sessions` VALUES ('38179194bd26bff922f465a87c512876', '192.168.137.87', 'Mozilla/5.0 (Linux; Android 10; Redmi Note 8 Pro Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Versi', '1597955662', '');
INSERT INTO `ci_sessions` VALUES ('401e211e7465be0ed801c7d9acff5710', '192.168.137.87', 'okhttp/3.12.1', '1597955896', '');
INSERT INTO `ci_sessions` VALUES ('41b673c012ef5545e36d5fd20468d778', '192.168.137.87', 'okhttp/3.12.1', '1597955923', '');
INSERT INTO `ci_sessions` VALUES ('4884b25593f4d3eee40364be0a1468cd', '192.168.137.87', 'Mozilla/5.0 (Linux; Android 10; Redmi Note 8 Pro Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Versi', '1597956032', '');
INSERT INTO `ci_sessions` VALUES ('49c472ea87e4893363e67b5bc3306e43', '192.168.137.87', 'okhttp/3.12.1', '1597958787', '');
INSERT INTO `ci_sessions` VALUES ('4c1ee059def1e2d2915cf4d3e1d920f6', '192.168.137.87', 'Mozilla/5.0 (Linux; Android 10; Redmi Note 8 Pro Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Versi', '1597955896', '');
INSERT INTO `ci_sessions` VALUES ('50ebde259bdf31bf25bd6342a2d72979', '192.168.137.87', 'okhttp/3.12.1', '1597956664', '');
INSERT INTO `ci_sessions` VALUES ('5166c042fa83431963f97cba1ad06cec', '192.168.137.87', 'okhttp/3.12.1', '1597956930', '');
INSERT INTO `ci_sessions` VALUES ('57dc33f314b7d316224dfcc7f7683d00', '192.168.137.252', 'okhttp/3.12.1', '1597976999', '');
INSERT INTO `ci_sessions` VALUES ('5b6eea63015fc02a073b5bdea05b12f2', '192.168.137.87', 'okhttp/3.12.1', '1597956032', '');
INSERT INTO `ci_sessions` VALUES ('614b672777ef03d91ba09ad5c4c75002', '192.168.137.87', 'Mozilla/5.0 (Linux; Android 10; Redmi Note 8 Pro Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Versi', '1597955923', '');
INSERT INTO `ci_sessions` VALUES ('6697a8774bb95fc48d4f64875f26f4e8', '192.168.137.87', 'Mozilla/5.0 (Linux; Android 10; Redmi Note 8 Pro) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Mobile Saf', '1597955992', '');
INSERT INTO `ci_sessions` VALUES ('66c61f613c0891e75bb0daf08c124216', '192.168.137.87', 'okhttp/3.12.1', '1597958185', '');
INSERT INTO `ci_sessions` VALUES ('7e85eb9d1744b15c1b084e6f3c82a89a', '192.168.137.87', 'Mozilla/5.0 (Linux; Android 10; Redmi Note 8 Pro Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Versi', '1597956720', '');
INSERT INTO `ci_sessions` VALUES ('7e8767f13ad50559c8d816f0734bb2e9', '192.168.137.87', 'okhttp/3.12.1', '1597955662', '');
INSERT INTO `ci_sessions` VALUES ('81d3a370940cff54e52a3207351ef71a', '192.168.137.87', 'okhttp/3.12.1', '1597956032', '');
INSERT INTO `ci_sessions` VALUES ('89b435fdf51ac55fe101bf10e3a21d4e', '192.168.137.87', 'okhttp/3.12.1', '1597955923', 'a:2:{s:9:\"user_data\";s:0:\"\";s:9:\"loginData\";a:2:{s:7:\"user_id\";s:1:\"1\";s:8:\"username\";s:5:\"ADMIN\";}}');
INSERT INTO `ci_sessions` VALUES ('8e423b71fdf7c67147c726d85c78baf2', '192.168.137.87', 'okhttp/3.12.1', '1597955466', 'a:1:{s:9:\"loginData\";a:2:{s:7:\"user_id\";s:1:\"1\";s:8:\"username\";s:5:\"ADMIN\";}}');
INSERT INTO `ci_sessions` VALUES ('956562b9f750957ab297c7617a7056cb', '192.168.137.87', 'okhttp/3.12.1', '1597954678', '');
INSERT INTO `ci_sessions` VALUES ('a2b86de7b4de1ff99b13117cd0e6e351', '192.168.137.87', 'Mozilla/5.0 (Linux; Android 10; Redmi Note 8 Pro Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Versi', '1597956930', '');
INSERT INTO `ci_sessions` VALUES ('af0c6f4ab5938a0413339fcac14e444e', '192.168.137.87', 'Mozilla/5.0 (Linux; Android 10; Redmi Note 8 Pro Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Versi', '1597956980', '');
INSERT INTO `ci_sessions` VALUES ('ba128515a6fc295cd664448d2181bf3b', '192.168.137.87', 'okhttp/3.12.1', '1597955662', '');
INSERT INTO `ci_sessions` VALUES ('bdc2881dace42779c399dd74f1633b3a', '192.168.137.87', 'okhttp/3.12.1', '1597956720', '');
INSERT INTO `ci_sessions` VALUES ('c44ee19bc9c290a43fc4c4d6a11edad2', '192.168.137.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36', '1597956734', '');
INSERT INTO `ci_sessions` VALUES ('db80527592524891b85544477505b1d5', '192.168.137.87', 'okhttp/3.12.1', '1597954678', 'a:2:{s:9:\"user_data\";s:0:\"\";s:9:\"loginData\";a:2:{s:7:\"user_id\";s:1:\"1\";s:8:\"username\";s:5:\"ADMIN\";}}');
INSERT INTO `ci_sessions` VALUES ('dc71f974ffbd0fa65716ec8101d47d1e', '192.168.137.87', 'okhttp/3.12.1', '1597956664', '');
INSERT INTO `ci_sessions` VALUES ('dfe48e08b69af1dc3d9bb90eeb86c45b', '192.168.137.87', 'okhttp/3.12.1', '1597958486', '');
INSERT INTO `ci_sessions` VALUES ('e6324c0ed02b18c0a4d036039bc3e084', '192.168.137.87', 'Mozilla/5.0 (Linux; Android 10; Redmi Note 8 Pro Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Versi', '1597954863', '');

-- ----------------------------
-- Table structure for jadwal
-- ----------------------------
DROP TABLE IF EXISTS `jadwal`;
CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `hari` varchar(255) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `aktifitas` varchar(255) DEFAULT '',
  PRIMARY KEY (`id_jadwal`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jadwal
-- ----------------------------
INSERT INTO `jadwal` VALUES ('2', 'Monday', '07:30:00', '15:00:00', 'Kegiatan Sekolah');
INSERT INTO `jadwal` VALUES ('3', 'Tuesday', '07:30:00', '15:00:00', 'Kegiatan Sekolah');
INSERT INTO `jadwal` VALUES ('4', 'Wednesday', '07:30:00', '15:00:00', 'Kegiatan Sekolah');
INSERT INTO `jadwal` VALUES ('5', 'Thursday', '07:30:00', '15:00:00', 'Kegiatan Sekolah');
INSERT INTO `jadwal` VALUES ('6', 'Friday', '07:30:00', '11:30:00', 'Kegiatan Sekolah');
INSERT INTO `jadwal` VALUES ('7', 'Saturday', '07:30:00', '12:00:00', 'Kegiatan Sekolah');

-- ----------------------------
-- Table structure for log_jadwal
-- ----------------------------
DROP TABLE IF EXISTS `log_jadwal`;
CREATE TABLE `log_jadwal` (
  `id_log_absensi` int(11) NOT NULL AUTO_INCREMENT,
  `id_jadwal` int(11) NOT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `tanggal` date NOT NULL,
  `nis` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_log_absensi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of log_jadwal
-- ----------------------------
INSERT INTO `log_jadwal` VALUES ('1', '2', '21:13:59', '21:16:47', '2020-08-17', '123');

-- ----------------------------
-- Table structure for ruangan
-- ----------------------------
DROP TABLE IF EXISTS `ruangan`;
CREATE TABLE `ruangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(11) NOT NULL,
  `ruangan` varchar(20) NOT NULL,
  `lantai` int(11) NOT NULL,
  `latlong_a` text NOT NULL,
  `latlong_b` text NOT NULL,
  `latlong_c` text NOT NULL,
  `latlong_d` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `is_deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_ruangan` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ruangan
-- ----------------------------
INSERT INTO `ruangan` VALUES ('1', 'AA103', 'AA 103', '1', '-6.470817, 106.865361', '-6.471318, 106.867850', '-6.473535, 106.866820', '-6.472437, 106.864438', '1', '2016-04-26 07:24:46', '2016-05-19 07:32:22', '0');
INSERT INTO `ruangan` VALUES ('2', 'AA105', 'AA 105', '1', '-6.203701318234037, 106.80178642272949', '-6.20361599016446, 106.80547714233398', '-6.206517136780392, 106.80547714233398', '-6.206687791966258, 106.80144309997559', '1', '2016-04-26 07:24:46', '2016-05-19 23:25:14', '0');
INSERT INTO `ruangan` VALUES ('3', 'AA104', 'AA 104', '1', '-6.203701318234037, 106.80178642272949', '-6.20361599016446, 106.80547714233398', '-6.206517136780392, 106.80547714233398', '-6.206687791966258, 106.80144309997559', '1', '2016-04-26 07:24:46', '2016-04-26 07:24:46', '0');
INSERT INTO `ruangan` VALUES ('4', 'AA201', 'AA 201', '2', '-6.217609608817, 106.81577682495117', '-6.20361599016446, 106.81534767150879', '-6.20813835881411, 106.81526184082031', '-6.207967704098153, 106.80985450744629', '1', '2016-04-26 07:24:46', '2016-05-15 19:23:51', '0');
INSERT INTO `ruangan` VALUES ('5', 'AA203', 'AA 203', '2', '-6.217609608817, 106.81577682495117', '-6.20361599016446, 106.81534767150879', '-6.20813835881411, 106.81526184082031', '-6.207967704098153, 106.80985450744629', '1', '2016-04-26 07:24:46', '2016-04-26 07:24:46', '0');
INSERT INTO `ruangan` VALUES ('6', 'AIUE', 'AIUEO', '2', '-6.20353066208104, 106.80985450744629', '-6.20361599016446, 106.81534767150879', '-6.20813835881411, 106.81526184082031', '-6.207967704098153, 106.80985450744629', '1', '2016-05-19 23:34:47', '2016-05-19 23:34:47', '0');

-- ----------------------------
-- Table structure for siswa
-- ----------------------------
DROP TABLE IF EXISTS `siswa`;
CREATE TABLE `siswa` (
  `nis` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) DEFAULT '0',
  `jnskel` varchar(1) DEFAULT '0',
  `nohp` varchar(13) DEFAULT '0',
  `nfc` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nis`),
  KEY `Index 1` (`nis`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of siswa
-- ----------------------------
INSERT INTO `siswa` VALUES ('123', 'Mantap', 'L', '08123123', '047F39A2126280', 'FI21082020025512570.jpg');
INSERT INTO `siswa` VALUES ('1231232', 'Budjang Inam', 'L', '08123456789', '', null);
INSERT INTO `siswa` VALUES ('32', 'Iya CUy', 'L', '123', '', null);

-- ----------------------------
-- Table structure for tipe_aktifitas
-- ----------------------------
DROP TABLE IF EXISTS `tipe_aktifitas`;
CREATE TABLE `tipe_aktifitas` (
  `id_tipe_aktifitas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_aktifitas` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_tipe_aktifitas`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tipe_aktifitas
-- ----------------------------
INSERT INTO `tipe_aktifitas` VALUES ('1', 'Masuk Kantor');
INSERT INTO `tipe_aktifitas` VALUES ('4', 'Pulang Kantor');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '1');
SET FOREIGN_KEY_CHECKS=1;
