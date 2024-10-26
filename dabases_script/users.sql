/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : 127.0.0.1:3309
Source Database       : system_ntti

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-10-24 18:42:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `pageination` decimal(10,0) DEFAULT NULL,
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `department_code` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `user_code` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_type` varchar(100) DEFAULT NULL,
  `role` varchar(50) DEFAULT '',
  `permission` varchar(100) DEFAULT NULL,
  `phone` decimal(50,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('10', '1', 'admin', 'D_IT', 'saypanha500@gmail.com', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', null, null, '2024-01-30 14:38:25', '2024-05-14 07:39:07', 'administrator', 'admin', 'admin', null);
INSERT INTO `users` VALUES ('4', '2', 'nha', 'D_IT', 'nha1@gmail.com', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', null, null, '2024-01-30 15:24:18', '2024-05-14 09:10:06', 'public_user', 'student', 'student', null);
INSERT INTO `users` VALUES ('4', '3', 'authorizer', 'D_IT', 'authorizer@gmail.com', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', null, null, '2024-01-30 15:24:18', '2024-05-14 09:10:06', 'public_user', 'user_department', 'user_department', null);
INSERT INTO `users` VALUES (null, '4', 'admin', 'D_IT', 'admin@gmail.com', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', null, null, '2024-05-14 19:30:19', '2024-05-14 19:30:21', null, 'teacher', 'teacher', null);
INSERT INTO `users` VALUES (null, '5', 'marketing', 'D_IT', 'marketing@gmail.com', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', null, null, null, null, null, '', '', null);
INSERT INTO `users` VALUES (null, '16', 'panha say', 'D_IT', 'test@gmail.com', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', null, null, '2024-05-15 13:12:46', '2024-05-15 13:12:46', null, '', null, '100211545');
INSERT INTO `users` VALUES (null, '17', 'panha say', 'D_IT', 'testw3@gmail.com', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', null, null, '2024-05-15 13:21:41', '2024-05-15 13:21:41', null, '', null, '101111');
INSERT INTO `users` VALUES (null, '18', 'pov', 'D_IT', 'pov@gmail.com', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', null, null, '2024-05-15 13:26:45', '2024-05-15 13:26:45', null, '', null, '123456789');
INSERT INTO `users` VALUES (null, '19', 'panha say', 'D_IT', 'intern@blue.com.kh', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', null, null, '2024-05-16 12:19:57', '2024-05-16 12:19:57', null, '', null, '123456789');
INSERT INTO `users` VALUES (null, '21', 'panha say', 'D_IT', 'nha@gmail.com', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', null, null, '2024-05-16 12:27:20', '2024-05-16 12:27:20', null, '', null, '105555');
INSERT INTO `users` VALUES (null, '25', 'panhaboy', 'D_IT', 'saypanha12345123456@gmail.com', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', null, null, '2024-06-26 13:03:01', '2024-06-26 13:03:01', null, '', null, '100000000');
INSERT INTO `users` VALUES (null, '27', 'panha', 'D_IT', 'saypanha23456781234567@gmail.com', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', null, null, '2024-07-02 13:13:37', '2024-07-02 13:13:37', null, '', null, '12345678');
INSERT INTO `users` VALUES (null, '29', 'Tang Jiou', 'D_IT', 'tanggiuoy@gmail.com', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', null, 'P_001', '2024-07-23 13:29:10', '2024-07-23 13:29:10', null, 'teachers', null, null);
INSERT INTO `users` VALUES (null, '31', 'cheacherda', 'D_IT', 'cheacherda@email.com', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', null, '471679', '2024-08-31 10:11:26', '2024-08-31 10:11:26', null, 'student', null, null);
INSERT INTO `users` VALUES (null, '34', 'Eng Vanna', 'D_IT', 'engvanna@gmail.com', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', null, 'P_007', '2024-09-03 12:21:13', '2024-09-03 12:21:13', null, 'teachers', null, null);
INSERT INTO `users` VALUES (null, '37', 'Tang Liheng', 'D_IT', 'tangliheng@gmail.com', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', null, 'P_009', '2024-09-03 12:40:46', '2024-09-03 12:40:46', null, 'teachers', null, null);
INSERT INTO `users` VALUES (null, '38', 'Kaing Koy', 'D_IT', 'kaingkoy@gmail.com', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', null, 'KOY001', '2024-09-09 13:34:12', '2024-09-09 13:34:12', null, 'teachers', null, null);
INSERT INTO `users` VALUES (null, '39', 'saypanha', 'D_IT', 'saypanha@email.com', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', null, '475433', '2024-09-28 02:42:17', '2024-09-28 02:42:17', null, 'student', null, null);
INSERT INTO `users` VALUES (null, '40', 'kemnorngme', 'D_IT', 'kemnorngme@email.com', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', null, '475435', '2024-09-28 08:26:58', '2024-09-28 08:26:58', null, 'student', null, null);
INSERT INTO `users` VALUES (null, '41', 'ruonchanpheakdey', 'D_IT', 'ruonchanpheakdey@email.com', null, '$2y$10$H9R.AXaf2phN9AWajJuthOu5slAqwtv2DWyeFZVLwdWL7OZTn8aZy', null, '500354', '2024-10-19 01:36:08', '2024-10-19 01:36:08', null, 'student', null, null);
