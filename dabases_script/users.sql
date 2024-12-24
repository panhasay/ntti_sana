/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : 127.0.0.1:3309
Source Database       : system_ntti

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-12-24 18:54:42
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
  `session_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('10', '1', 'PANHA', 'D_IT', 'saypanha500@gmail.com', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', '$2y$10$vXd2SeWAw/ddIwEpRc5HGOPaM6x9OW/gk82CRqlazLeQAR3cQOeZq', '475433', '2024-01-30 14:38:25', '2024-12-24 18:53:28', 'administrator', 'admin', 'admin', null, '$2y$10$H3AYpieG0mJE.WolNWgULuu6j00g5HPKwR4I/4JL6An.XZEmnQNLe');
INSERT INTO `users` VALUES (null, '40', 'kemnorngme', 'D_IT', 'kemnorngme@email.com', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', 'fpE2FKiinXDXodgth1iIq2YIOJND3S0eSHywwQHNJbMhTppfT1qb0QwnhcwD', '475435', '2024-09-28 08:26:58', '2024-09-28 08:26:58', null, 'student', null, null, null);
INSERT INTO `users` VALUES (null, '41', 'ruonchanpheakdey', 'D_IT', 'ruonchanpheakdey@email.com', null, '$2y$10$H9R.AXaf2phN9AWajJuthOu5slAqwtv2DWyeFZVLwdWL7OZTn8aZy', 'fpE2FKiinXDXodgth1iIq2YIOJND3S0eSHywwQHNJbMhTppfT1qb0QwnhcwD', '500354', '2024-10-19 01:36:08', '2024-10-19 01:36:08', null, 'student', null, null, null);
INSERT INTO `users` VALUES (null, '42', 'songveasna', 'D_IT', 'songveasna@email.com', null, '$2y$10$gyom/6087VrnN43OR.beaOjumvAFIQ0Ok6wWOtZvzuuBWj85VXfHq', 'fpE2FKiinXDXodgth1iIq2YIOJND3S0eSHywwQHNJbMhTppfT1qb0QwnhcwD', '475177', '2024-10-26 08:04:14', '2024-10-26 08:04:14', null, 'student', null, null, null);
INSERT INTO `users` VALUES (null, '43', 'saypanha', 'D_IT', 'saypanha@email.com', null, '$2y$10$xRIuLWYK/CCxQ1MVZdWPF.Fb1LajJLIwWNT9kJpdVEFA8queaPt1G', 'fpE2FKiinXDXodgth1iIq2YIOJND3S0eSHywwQHNJbMhTppfT1qb0QwnhcwD', '475433', '2024-11-04 20:02:33', '2024-11-04 20:02:33', null, 'student', null, null, null);
INSERT INTO `users` VALUES (null, '48', 'Kaet Bora', 'D_IT', 'bora@gmail.com', null, '$2y$10$EMeGv/ueW.iAE9mgt5tBsu7r/H9QWQgri7RofatZiBCtnIq.Dhi1.', '4w0TruGoOid3rr5tPECOypfojpIuZOh4evizYLcLaZar2nKgs65MfAynlzIN', 'P_080', '2024-11-22 21:43:47', '2024-12-14 16:32:15', null, 'teachers', null, null, '');
INSERT INTO `users` VALUES (null, '49', 'HY LENGSE', 'D_IT', 'hylengse@gmail.com', null, '$2y$10$do02co1EnO1guCZYQjgtTOltOsXcyp2LyUeRnqhMdycMWnRIgGiaK', 'fpE2FKiinXDXodgth1iIq2YIOJND3S0eSHywwQHNJbMhTppfT1qb0QwnhcwD', 'P_081', '2024-11-23 01:24:30', '2024-11-23 01:24:30', null, 'teachers', null, null, null);
INSERT INTO `users` VALUES (null, '50', 'Heak Channarith', 'D_S_EN', 'channarith@gmail.com', null, '$2y$10$OSEtGzNcgtWlSm6z97gpf.XtA7Li4CAyZu1V9uajLW3sSLJ0uQyJe', 'fpE2FKiinXDXodgth1iIq2YIOJND3S0eSHywwQHNJbMhTppfT1qb0QwnhcwD', 'P_024', '2024-11-23 01:37:01', '2024-11-23 01:37:01', null, 'teachers', null, null, null);
INSERT INTO `users` VALUES (null, '51', 'Taing Narin', 'D_EL', 'taingnarin@gmail.com', null, '$2y$10$28gAaQSKgJp7u6IrF99EYuw827G37vhyDFBRtjNKzlakGbObQ8fee', 'fpE2FKiinXDXodgth1iIq2YIOJND3S0eSHywwQHNJbMhTppfT1qb0QwnhcwD', 'E000_01', '2024-11-23 01:41:37', '2024-11-23 01:41:37', null, 'teachers', null, null, null);
INSERT INTO `users` VALUES (null, '52', 'Sam Visara', 'D_CL', 'samvisara@gmail.com', null, '$2y$10$8.8oK4x9sF8d2FqywS/EXOFh.IUebtrhg3Nd1SX7njNw1taKlXGm.', 'fpE2FKiinXDXodgth1iIq2YIOJND3S0eSHywwQHNJbMhTppfT1qb0QwnhcwD', 'CL00012', '2024-11-23 01:45:25', '2024-11-23 01:45:25', null, 'teachers', null, null, null);
INSERT INTO `users` VALUES (null, '54', 'Eng Vanna', 'D_CL', 'engvanna@gmail.com', null, '$2y$10$4AWoFRQ7R3Q.togrPQQ8VegkaGb/3vBb8uBVOQVt1op1c86F0JIcS', 'dWl1vjRI2gOWIIp6b2Z0Rv3jlfFqLH1qUuEdeOm8k8uTy9wNYF8eI3TPhUZr', 'P_007', '2024-11-23 01:55:08', '2024-12-23 20:27:05', null, 'teachers', null, null, '');
INSERT INTO `users` VALUES (null, '55', 'Tang Liheng', 'D_IT', 'tangliheng@gmail.com', null, '$2y$10$XMoXVzoH4qEsn9n.UYDGlOnZKLTxuaEfoYhkmmZmdiZRnAvutGwUS', 'BBwvmfsmTuG5Qo97HA46G9EmYcsb4OFBQrDBQoaSSDzfLmFDYRZIdFx6DmOT', 'P_009', '2024-11-23 15:34:05', '2024-12-17 18:49:20', null, 'teachers', null, null, '');
INSERT INTO `users` VALUES (null, '57', 'User Attendant', 'D_IT', 'userattendant@gmail.com', null, '$2y$10$nOhYQamcRddtkc2edAcuP.Dj2.RMU3x8Hdz5GiHm2FTMxaYMfTXOi', '$2y$10$W.4QWwGxTTWYOjrR6dNDouOYsdJLsjnw8MNoJV01aTe27rkoCeiae', 'P_009', '2024-12-14 08:29:47', '2024-12-23 19:54:23', null, 'attendant', null, null, '$2y$10$5Hn3nUz94Lajh5aFfsBCr.J1hF0toYFCANTKloLeDMGSPChe6g49i');
INSERT INTO `users` VALUES (null, '58', 'Kaing Koy', 'D_IT', 'kaingkoy@gmail.com', null, '$2y$10$NWb/KJqqnnkVXciLAJTHpef1nJ8ULnan8BhvPXnV/2H59Xjs3ZxUa', 'Rrd1YlI6DT3URvq14m0mijYyJO4sv9S2EXGzArnaowhm16vCDkgtgcVX4UzN', 'KOY001', '2024-12-14 14:33:12', '2024-12-14 16:24:57', null, 'teachers', null, null, '');
INSERT INTO `users` VALUES (null, '59', 'Long Chenda', 'D_EL', 'longchenda@gmail.com', null, '$2y$10$zWChq3aLUcwL84LagAz4hOpgV1xz5b4PeD48GpXPadNM..jcuxv4C', '$2y$10$hZWNxGSx7/H7.4Eap.bSLuMOg1MzRg1iG9g7Uy28Scao9zqXGdNb2', 'P_008', '2024-12-14 16:33:58', '2024-12-14 16:34:11', null, 'teachers', null, null, null);
